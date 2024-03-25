<?php
require_once 'db.php';
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in session upon login

    // Basic validation
    if (empty($title) || empty($content) || empty($category_id)) {
        // Redirect back to create post form with an error message
        header('Location: create_post.php?error=Please fill in all fields');
        exit();
    }

    // Insert post into database
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, category_id, user_id) VALUES (:title, :content, :category_id, :user_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'category_id' => $category_id, 'user_id' => $user_id]);

    // Redirect to the homepage or to the newly created post
    header('Location: index.php?success=Post created successfully');
    exit();
} else {
    // Redirect to the create post form if the request method is not POST
    header('Location: create_post.php');
    exit();
}
?>
