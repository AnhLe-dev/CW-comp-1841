<?php
session_start();

// Admin credentials
$ActualEmail = "admin@vn.com";
$ActualPassword = "1";

// Validate that both email and password were submitted
if (!isset($_POST['email']) || !isset($_POST['password'])) {
    $_SESSION['error'] = "Please provide both email and password";
    header("Location: admin_login.html");
    exit();
}

// Get and sanitize inputs
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password']);

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format";
    header("Location: admin_login.html");
    exit();
}

// Check credentials
if ($email === $ActualEmail && $password === $ActualPassword) {
    // Valid login
    $_SESSION["Authorised"] = "Y";
    $_SESSION["AdminEmail"] = $email;
    
    // Redirect to admin area
    header("Location: ../posts.php");
    exit();
} else {
    // Invalid login
    $_SESSION['error'] = "Invalid email or password";
    header("Location: Wrongpassword.php");
    exit();
}