<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../student-login/css/signin&up.css">
</head>
<body>
<div class="container">
    <h2>Register Account</h2>

    <?php if (!empty($successMessage)) echo '<p class="message" style="color:green">' . $successMessage . '</p>'; ?>
    <?php if (!empty($errorMessage)) echo '<p class="message">' . $errorMessage . '</p>'; ?>

    <form method="post" action="register.php">
    <input type="text" name="nameStudent" placeholder="Enter your name" required>
    <input type="email" name="email" placeholder="Enter your email" required>
    <input type="password" name="password" required minlength="1">
    <input type="submit" name="register" value="Create Account">
</form>
        
    <p>Already have an account? <a href="../student-login/login.php">Login</a></p>
</div>
</body>
</html>