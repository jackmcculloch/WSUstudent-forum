<?php
session_start();
session_destroy(); // Destroy the session, logging the user out
header("Location: login.php"); // Redirect to the login page
exit();
