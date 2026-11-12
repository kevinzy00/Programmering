
<?php
require_once "db.php";

$sql = "SELECT klassekode, klassenavn, studiumkode
        FROM klasse
        ORDER BY klassekode";

$resultat = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="no">

<head>
  <meta charset="UTF-8">
  <title>Vis alle klasser</title>
</head>

<body>

  <h1>Alle klasser</h1>

  <table border="1">
    <thead>
      <tr>
        <th>Klassekode</th>
        <th>Klassenavn</th>
        <th>Studiumkode</th>
      </tr>
    </thead>

    <tbody>

      <?php
      if ($resultat->num_rows > 0) {

          while ($rad = $resultat->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($rad["klassekode"]) . "</td>";
              echo "<td>" . htmlspecialchars($rad["klassenavn"]) . "</td>";
              echo "<td>" . htmlspecialchars($rad["studiumkode"]) . "</td>";
              echo "</tr>";
          }

      } else {
          echo "<tr><td colspan='3'>Ingen klasser registrert.</td></tr>";
      }
      ?>

    </tbody>
  </table>

  <br>

  <a href="index.php">
    <strong>Tilbake til start</strong>
  </a>

</body>
</html>

<?php
$conn->close();
?>
