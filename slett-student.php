<?php
require_once "db.php";
$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $brukernavn = trim($_POST["brukernavn"] ?? "");
    if ($brukernavn === "") {
        $melding = "Velg en student.";
    } else {
        try {
            $stmt = $conn->prepare("DELETE FROM student WHERE brukernavn = ?");
            $stmt->bind_param("s", $brukernavn);
            $stmt->execute();
            $melding = $stmt->affected_rows > 0
                ? "Studenten ble slettet!"
                : "Studenten finnes ikke.";
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            $melding = "Databasefeil. Sjekk Dokploy-loggene.";
        }
    }
}

$studenter = $conn->query(
    "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY brukernavn"
);
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Slett student</title>
</head>
<body>
  <h1>Slett student</h1>
  <?php if ($melding !== ""): ?>
    <p><?= htmlspecialchars($melding, ENT_QUOTES, "UTF-8") ?></p>
  <?php endif; ?>
  <form method="post" action="slett-student.php" onsubmit="return confirm('Er du sikker på at du vil slette studenten?');">
    <label for="brukernavn">Velg student:</label>
    <select id="brukernavn" name="brukernavn" required>
      <option value="">Velg student</option>
      <?php while ($rad = $studenter->fetch_assoc()): ?>
        <option value="<?= htmlspecialchars($rad["brukernavn"], ENT_QUOTES, "UTF-8") ?>">
          <?= htmlspecialchars($rad["brukernavn"] . " - " . $rad["fornavn"] . " " . $rad["etternavn"], ENT_QUOTES, "UTF-8") ?>
        </option>
      <?php endwhile; ?>
    </select>
    <br><br>
    <input type="submit" value="Slett student">
  </form>
  <br>
  <a href="index.php"><strong>Tilbake til start</strong></a>
</body>
</html>
<?php $conn->close(); ?>
