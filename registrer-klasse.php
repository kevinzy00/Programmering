
<?php
require_once "db.php";

$melding = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $klassekode = trim($_POST["klassekode"] ?? "");
    $klassenavn = trim($_POST["klassenavn"] ?? "");
    $studiumkode = trim($_POST["studiumkode"] ?? "");

    if ($klassekode === "" || $klassenavn === "" || $studiumkode === "") {
        $melding = "Alle felt må fylles ut.";
    } elseif (strlen($klassekode) > 5) {
        $melding = "Klassekode kan maks være 5 tegn.";
    } else {
        try {
            $sql = "INSERT INTO klasse
                    (klassekode, klassenavn, studiumkode)
                    VALUES (?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $klassekode,
                $klassenavn,
                $studiumkode
            ]);

            $melding = "Klassen ble registrert!";

        } catch (PDOException $e) {
            if ($e->getCode() == "23000") {
                $melding = "Klassekoden finnes allerede.";
            } else {
                error_log($e->getMessage());
                $melding = "Databasefeil. Sjekk Dokploy-loggene.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <title>Registrer klasse</title>
</head>
<body>

<h1>Registrer klasse</h1>

<p><?= htmlspecialchars($melding) ?></p>

<form method="post" action="registrer-klasse.php">
    <label>Klassekode:</label>
    <input type="text" name="klassekode" maxlength="5" required>

    <br><br>

    <label>Klassenavn:</label>
    <input type="text" name="klassenavn" maxlength="50" required>

    <br><br>

    <label>Studiumkode:</label>
    <input type="text" name="studiumkode" maxlength="50" required>

    <br><br>

    <input type="submit" value="Registrer klasse">
    <input type="reset" value="Nullstill">
</form>

<br>
<a href="index.php">Tilbake til start</a>

</body>
</html>
