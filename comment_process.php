<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    // Validate and sanitize inputs
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $user_id = $_SESSION['user_id'];

    if ($post_id && $content) {
        // Insert comment into the database
        $stmt = $pdo->prepare("INSERT INTO comments (content, post_id, user_id) VALUES (?, ?, ?)");
        $stmt->execute([$content, $post_id, $user_id]);
        
        // Redirect back to the post
        header("Location: view_post.php?id=$post_id");
        exit();
    } else {
        // Handle error or redirect as needed
        echo "Invalid input.";
    }
} else {
    // Redirect to login or error page
    header('Location: login.php');
    exit();
}

?>
