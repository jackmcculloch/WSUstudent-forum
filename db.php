<?php
$host = 'localhost'; // or your database host
$dbName = 'id21638583_forum'; // updated database name
$username = 'id21638583_expokemon1'; // your database username
$password = 'Expokemon1!'; // your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbName: " . $e->getMessage());
}
?>
