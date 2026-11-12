<?php
require_once "db.php";
$resultat = $conn->query(
    "SELECT brukernavn, fornavn, etternavn, klassekode FROM student ORDER BY brukernavn"
);
?>
<!DOCTYPE html>
<html lang="no">
<head>
  <meta charset="UTF-8">
  <title>Vis alle studenter</title>
</head>
<body>
  <h1>Alle studenter</h1>
  <table border="1">
    <thead>
      <tr>
        <th>Brukernavn</th>
        <th>Fornavn</th>
        <th>Etternavn</th>
        <th>Klassekode</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($resultat->num_rows === 0): ?>
        <tr><td colspan="4">Ingen studenter registrert.</td></tr>
      <?php else: ?>
        <?php while ($rad = $resultat->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($rad["brukernavn"], ENT_QUOTES, "UTF-8") ?></td>
            <td><?= htmlspecialchars($rad["fornavn"], ENT_QUOTES, "UTF-8") ?></td>
            <td><?= htmlspecialchars($rad["etternavn"], ENT_QUOTES, "UTF-8") ?></td>
            <td><?= htmlspecialchars($rad["klassekode"], ENT_QUOTES, "UTF-8") ?></td>
          </tr>
        <?php endwhile; ?>
      <?php endif; ?>
    </tbody>
  </table>
  <br>
  <a href="index.php"><strong>Tilbake til start</strong></a>
</body>
</html>
<?php $conn->close(); ?>
