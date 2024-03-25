<?php
function redirect($url) {
    header("Location: $url");
    exit;
}

function checkLogin() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        redirect('login.php');
    }
}

function sanitizeInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

// Add any additional utility functions below
?>
