<?php
require_once 'header.php'; // Include the header

// Redirect user to login page if not logged in
if (!$userLoggedIn) {
    header('Location: login.php');
    exit();
}

// Check if a category_id is passed and validate it
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;

// Fetch categories for the dropdown, including the selected one if applicable
$stmt = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission here, similar to the previously discussed post_process.php logic
}

?>

<div class="main-content">
    <h2>Create a New Post</h2>
    <form action="post_process.php" method="post">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select id="category" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= $category['id'] === $category_id ? 'selected' : '' ?>><?= htmlspecialchars($category['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" required></textarea>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<?php
require_once 'footer.php'; // Include the footer
?>

