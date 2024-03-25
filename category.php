<?php
require_once 'header.php'; // Include the header

// Assuming you pass the category ID in the URL, e.g., category.php?id=1
$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch category details from the database
$stmt = $pdo->prepare("SELECT name, description FROM categories WHERE id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo "<p>Category not found.</p>";
} else {
    // Display category name and description
    echo "<div class='category'>";
    echo "<h2>" . htmlspecialchars($category['name']) . "</h2>";
    echo "<p>" . nl2br(htmlspecialchars($category['description'])) . "</p>";
    echo "</div>";

    // Check if user is logged in before showing create post link
    if ($userLoggedIn) {
        echo "<div><a href='create_post.php?category_id=" . urlencode($category_id) . "' class='btn'>Create New Post in " . htmlspecialchars($category['name']) . "</a></div>";
    } else {
        echo "<p><a href='login.php'>Log in</a> to create a post.</p>";
    }

    // Fetch and display posts in this category
    $stmt = $pdo->prepare("SELECT id, title, content FROM posts WHERE category_id = ? ORDER BY created_at DESC");
    $stmt->execute([$category_id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($posts) {
        foreach ($posts as $post) {
            echo "<div class='post'>";
            echo "<h3><a href='view_post.php?id=" . htmlspecialchars($post['id']) . "'>" . htmlspecialchars($post['title']) . "</a></h3>";
            echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts in this category yet.</p>";
    }
}

require_once 'footer.php'; // Include the footer
?>

