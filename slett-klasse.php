<?php
require_once "db.php";
$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $klassekode = trim($_POST["klassekode"] ?? "");
    if ($klassekode === "") {
        $melding = "Velg en klasse.";
    } else {
        try {
            $sjekk = $conn->prepare("SELECT COUNT(*) FROM student WHERE klassekode = ?");
            $sjekk->bind_param("s", $klassekode);
            $sjekk->execute();
            $sjekk->bind_result($antall);
            $sjekk->fetch();
            $sjekk->close();

            if ($antall > 0) {
                $melding = "Kan ikke slette klassen fordi den har studenter.";
            } else {
                $stmt = $conn->prepare("DELETE FROM klasse WHERE klassekode = ?");
                $stmt->bind_param("s", $klassekode);
                $stmt->execute();
                $melding = $stmt->affected_rows > 0
                    ? "Klassen ble slettet!"
                    : "Klassen finnes ikke.";
                $stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1451) {
                $melding = "Kan ikke slette klassen fordi den har studenter.";
            } else {
                error_log($e->getMessage());
                $melding = "Databasefeil. Sjekk Dokploy-loggene.";
            }
        }
    }
}

$klasser = $conn->query("SELECT klassekode, klassenavn FROM klasse ORDER BY klassekode");
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Slett klasse</title>
</head>
<body>
  <h1>Slett klasse</h1>
  <?php if ($melding !== ""): ?>
    <p><?= htmlspecialchars($melding, ENT_QUOTES, "UTF-8") ?></p>
  <?php endif; ?>
  <form method="post" action="slett-klasse.php" onsubmit="return confirm('Er du sikker på at du vil slette klassen?');">
    <label for="klassekode">Velg klasse:</label>
    <select id="klassekode" name="klassekode" required>
      <option value="">Velg klasse</option>
      <?php while ($rad = $klasser->fetch_assoc()): ?>
        <option value="<?= htmlspecialchars($rad["klassekode"], ENT_QUOTES, "UTF-8") ?>">
          <?= htmlspecialchars($rad["klassekode"] . " - " . $rad["klassenavn"], ENT_QUOTES, "UTF-8") ?>
        </option>
      <?php endwhile; ?>
    </select>
    <br><br>
    <input type="submit" value="Slett klasse">
  </form>
  <br>
  <a href="index.php"><strong>Tilbake til start</strong></a>
</body>
</html>
<?php $conn->close(); ?>
