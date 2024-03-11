<?php
require_once 'db.php';
require_once 'functions.php';

// Fetch all categories from the database
$stmt = $pdo->prepare("SELECT * FROM Categories ORDER BY name ASC");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wayne State University Forum</title>
    <link rel="stylesheet" href="style.css"> <!-- Make sure to create this CSS file -->
</head>
<body>
<header>
    <h1>Welcome to Wayne State University Forum</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>
    <section>
        <h2>Categories</h2>
        <ul>
            <?php foreach ($categories as $category): ?>
                <li><a href="category.php?id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
</body>
</html>
