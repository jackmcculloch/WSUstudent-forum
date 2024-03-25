<?php require_once 'header.php'; ?>
<div class="login-form">
    <h2>Login</h2>
    <form action="login_process.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
<?php require_once 'footer.php'; ?>
