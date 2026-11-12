<?php

$host = "b-studentsql-1.usn.no";
$dbname = "keboe7753";

$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");

$conn = new mysqli(
    $host,
    $username,
    $password,
    $dbname
);

$conn->set_charset("utf8mb4");
?>
