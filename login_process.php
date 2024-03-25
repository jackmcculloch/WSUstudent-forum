<?php
session_start();
require_once 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch the user from the database
$query = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
$query->execute([$username]);
$user = $query->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id']; // Set user session
    header("Location: index.php");
} else {
    // Handle login failure
    header("Location: login.php?error=invalid_credentials");
}
exit();
