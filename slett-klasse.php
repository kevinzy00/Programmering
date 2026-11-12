<!DOCTYPE html>
<html lang="no">

<head>
  <meta charset="UTF-8">
  <title>Slett klasse</title>
</head>

<body>

  <h1>Slett klasse</h1>

  <form method="post" action="slett-klasse.php">

    <label for="klassekode">Velg klasse:</label>
    <select id="klassekode" name="klassekode" required>
      <option value="">Velg klasse</option>
    </select>

    <br><br>

    <input type="submit" value="Slett klasse">

  </form>

  <a href="index.php"> <strong>Tilbake til start</strong></a>

</body>

</html>
