<!DOCTYPE html>
<html lang="no">

<head>
  <meta charset="UTF-8">
  <title>Slett student</title>
</head>

<body>

  <h1>Slett student</h1>

  <form method="post" action="slett-student.php">

    <label for="brukernavn">Velg student:</label>
    <select id="brukernavn" name="brukernavn" required>
      <option value="">Velg student</option>
    </select>

    <br><br>

    <input type="submit" value="Slett student">

  </form>

  <a href="index.php"> <strong>Tilbake til start</strong></a>

</body>

</html>
