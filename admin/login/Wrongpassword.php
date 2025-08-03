<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : 'Invalid email or password';
unset($_SESSION['error']); // Clear the error message
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Error</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="error-message">
            <h2>Login Failed</h2>
            <p><?php echo htmlspecialchars($error); ?></p>
            <a href="admin_login.html" class="back-btn">Try Again</a>
        </div>
    </div>
</body>
</html>
