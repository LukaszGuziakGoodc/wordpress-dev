<?php

$host = 'db';
$db   = 'wpdb';
$user = 'wpuser';
$pass = 'wppass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "Połączenie z bazą działa poprawnie!";
} catch (PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}
