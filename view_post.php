<?php
require_once 'header.php'; // Include the header

// Fetch the post from the database
$post_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$post_id) {
    echo "<p>Invalid post ID.</p>";
    require_once 'footer.php'; // Include the footer
    exit;
}

$stmt = $pdo->prepare("SELECT posts.title, posts.content, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "<p>Post not found.</p>";
    require_once 'footer.php'; // Include the footer
    exit;
}

// Display the post
?>
<div class="post">
    <h2><?= htmlspecialchars($post['title']) ?></h2>
    <p>Posted by <?= htmlspecialchars($post['username']) ?></p>
    <div><?= nl2br(htmlspecialchars($post['content'])) ?></div>
</div>

<?php if ($userLoggedIn): ?>
    <h3>Leave a Comment</h3>
    <form action="comment_process.php" method="post">
        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post_id) ?>">
        <textarea name="content" rows="4" required></textarea>
        <button type="submit">Submit Comment</button>
    </form>
<?php else: ?>
    <p><a href="login.php">Log in</a> to comment.</p>
<?php endif; ?>

<?php
// Fetch and display comments for the post
$stmt = $pdo->prepare("SELECT comments.content, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY comments.created_at DESC");
$stmt->execute([$post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($comments):
?>
    <h3>Comments</h3>
    <div class="comments">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><?= htmlspecialchars($comment['username']) ?> says:</p>
                <div><?= nl2br(htmlspecialchars($comment['content'])) ?></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No comments yet. Be the first to comment!</p>
<?php endif; ?>

<?php
require_once 'footer.php'; // Include the footer
?>

