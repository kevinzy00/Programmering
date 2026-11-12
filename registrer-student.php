<?php
require_once "db.php";

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $brukernavn = trim($_POST["brukernavn"] ?? "");
    $fornavn = trim($_POST["fornavn"] ?? "");
    $etternavn = trim($_POST["etternavn"] ?? "");
    $klassekode = trim($_POST["klassekode"] ?? "");

    if ($brukernavn === "" || $fornavn === "" || $etternavn === "" || $klassekode === "") {
        $melding = "Alle felt må fylles ut.";
    } elseif (strlen($brukernavn) > 7 || mb_strlen($fornavn) > 50 || mb_strlen($etternavn) > 50) {
        $melding = "Ett eller flere felt er for lange.";
    } else {
        try {
            $stmt = $conn->prepare(
                "INSERT INTO student (brukernavn, fornavn, etternavn, klassekode) VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("ssss", $brukernavn, $fornavn, $etternavn, $klassekode);
            $stmt->execute();
            $stmt->close();
            $melding = "Studenten ble registrert!";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $melding = "Brukernavnet finnes allerede.";
            } elseif ($e->getCode() == 1452) {
                $melding = "Klassen finnes ikke.";
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
  <title>Registrer student</title>
</head>
<body>
  <h1>Registrer student</h1>
  <?php if ($melding !== ""): ?>
    <p><?= htmlspecialchars($melding, ENT_QUOTES, "UTF-8") ?></p>
  <?php endif; ?>
  <form method="post" action="registrer-student.php">
    <label for="brukernavn">Brukernavn:</label>
    <input type="text" id="brukernavn" name="brukernavn" maxlength="7" required>
    <br><br>
    <label for="fornavn">Fornavn:</label>
    <input type="text" id="fornavn" name="fornavn" maxlength="50" required>
    <br><br>
    <label for="etternavn">Etternavn:</label>
    <input type="text" id="etternavn" name="etternavn" maxlength="50" required>
    <br><br>
    <label for="klassekode">Klasse:</label>
    <select id="klassekode" name="klassekode" required>
      <option value="">Velg klasse</option>
      <?php while ($rad = $klasser->fetch_assoc()): ?>
        <option value="<?= htmlspecialchars($rad["klassekode"], ENT_QUOTES, "UTF-8") ?>">
          <?= htmlspecialchars($rad["klassekode"] . " - " . $rad["klassenavn"], ENT_QUOTES, "UTF-8") ?>
        </option>
      <?php endwhile; ?>
    </select>
    <br><br>
    <input type="submit" value="Registrer student">
    <input type="reset" value="Nullstill">
  </form>
  <br>
  <a href="index.php"><strong>Tilbake til start</strong></a>
</body>
</html>
<?php $conn->close(); ?>
