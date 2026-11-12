<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrer Klasse</title>
</head>

<body>

  <h1>Registtrer klasse</h1>

  <form method="post" action="registrer-klasse.php">
    <label for="klassekode">Klassekode: </label>
    <input type="text" name="klassekode" id="klassekode" required>

    <br><br>

    <label for="klassenavn">Klassenavn: </label>
    <input type="text" name="klassenavn" id="klassenavn" required>

    <br><br>

    <input type="submit" value="Registrer klasse">
    <input type="reset" value="Nullstill">
  </form>

  <a href="index.php"> <strong>Tilbake til start</strong></a>

</body>

</html>
