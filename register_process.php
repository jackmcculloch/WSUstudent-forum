<?php
require_once 'db.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password

// Insert the user into the database
$query = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$query->execute([$username, $password]);

header("Location: login.php"); // Redirect to login page after registration
exit();
