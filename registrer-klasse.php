
<!DOCTYPE html>
<html lang="no">

<head>
  <meta charset="UTF-8">
  <title>Registrer Klasse</title>
</head>

<body>

  <h1>Registrer klasse</h1>

  <form method="post" action="registrer-klasse.php">

    <label for="klassekode">Klassekode:</label>
    <input type="text" name="klassekode"
           id="klassekode" maxlength="5" required>

    <br><br>

    <label for="klassenavn">Klassenavn:</label>
    <input type="text" name="klassenavn"
           id="klassenavn" maxlength="50" required>

    <br><br>

    <label for="studiumkode">Studiumkode:</label>
    <input type="text" name="studiumkode"
           id="studiumkode" maxlength="50" required>

    <br><br>

    <input type="submit" value="Registrer klasse">
    <input type="reset" value="Nullstill">

  </form>

  <br>

  <a href="index.php">Tilbake til start</a>

</body>
</html>
