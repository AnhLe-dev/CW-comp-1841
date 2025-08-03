<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../student-login/css/signin&up.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>

    <?php if (!empty($successMessage)) echo '<p class="message" style="color:green">' . $successMessage . '</p>'; ?>
    <?php if (!empty($errorMessage)) echo '<p class="message">' . $errorMessage . '</p>'; ?>

    <form method="post" action="login.php">
        <label>Username or Email:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <input type="submit" name="login" value="Login">
    </form>
    <p>Don't have an account? <a href="../student-login/register.php">Register</a></p>
</div>
</body>
</html>
