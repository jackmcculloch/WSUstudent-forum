<?php
session_start();
require_once 'db.php';

// Check if user is logged in
$userLoggedIn = isset($_SESSION['user_id']);
$userName = $userLoggedIn ? $_SESSION['username'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wayne State University Forum</title>
    <link rel="stylesheet" href="style.css"> <!-- Ensure you create a CSS file with your styles -->
</head>
<body>
<header>
    <div class="container">
        <h1><a href="index.php">WSU Forum</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if ($userLoggedIn): ?>
                    <li><a href="create_post.php">Create Post</a></li>
                    <li><a href="profile.php">Profile </a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<div class="container main-content">
