<!DOCTYPE html>
<html lang="no">

<head>
  <meta charset="UTF-8">
  <title>Registrer student</title>
</head>

<body>

  <h1>Registrer student</h1>

  <form method="post" action="registrer-student.php">

    <label for="brukernavn">Brukernavn:</label>
    <input type="text" id="brukernavn" name="brukernavn"
      maxlength="7" required>

    <br><br>

    <label for="fornavn">Fornavn:</label>
    <input type="text" id="fornavn" name="fornavn"
      maxlength="50" required>

    <br><br>

    <label for="etternavn">Etternavn:</label>
    <input type="text" id="etternavn" name="etternavn"
      maxlength="50" required>

    <br><br>

    <label for="klassekode">Klasse:</label>
    <select id="klassekode" name="klassekode" required>
      <option value="">Velg klasse</option>
    </select>

    <br><br>

    <input type="submit" value="Registrer student">
    <input type="reset" value="Nullstill">

  </form>

 <a href="index.php"> <strong>Tilbake til start</strong></a>

</body>

</html>
