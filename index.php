<?php
require_once 'header.php'; // Ensure the header is included at the start

// Your existing PHP code for fetching categories or any initializations here
require_once 'db.php'; // Assuming 'db.php' connects to your database

$stmt = $pdo->query("SELECT id, name, description FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-content">
    <h2>Welcome to the Wayne State University Forum</h2>
    <p>Browse the categories below to participate in discussions:</p>
    <div class="categories">
        <?php foreach ($categories as $category): ?>
            <div class="category">
                <h3><a href="category.php?id=<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['name']) ?></a></h3>
                <p><?= nl2br(htmlspecialchars($category['description'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require_once 'footer.php'; // Ensure the footer is included at the end
