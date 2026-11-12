
<?php

$host = "b-studentsql-1.usn.no";
$dbname = "keboe7753";

$username = getenv(" keboe7753");
$password = getenv("8a1bkeboe7753");

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Kunne ikke koble til databasen.");
}
