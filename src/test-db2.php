<?php

$host = 'db';
$db   = 'wpdb';
$user = 'wpuser';
$pass = 'wppass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    echo "<p>Połączenie działa!</p>";

    // 1. Tworzymy tabelę jeśli nie istnieje
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS people (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL
        ) ENGINE=INNODB;
    ");

    echo "<p>Tabela people jest gotowa.</p>";

    // 2. Dodajemy rekord
    $stmt = $pdo->prepare("INSERT INTO people (name) VALUES (:name)");
    $stmt->execute(['name' => 'Jan Kowalski']);

    echo "<p>Dodano rekord.</p>";

    // 3. Pobieramy wszystkie rekordy
    $stmt = $pdo->query("SELECT * FROM people");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h3>Dane w tabeli:</h3>";
    echo "<pre>";
    print_r($rows);
    echo "</pre>";

} catch (PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}
