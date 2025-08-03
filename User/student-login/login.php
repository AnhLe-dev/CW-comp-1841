<?php
session_start();
include '../../include/DatabaseConnection.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM users WHERE nameStudent = :username OR email = :username";
        $query = $pdo->prepare($sql);
        $query->execute(['username' => $username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Đăng nhập thành công
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nameStudent'] = $user['nameStudent'];
            header("Location: ../index.php");
            exit();
        } else {
            // Sai thông tin đăng nhập
            $_SESSION['error_message'] = "Invalid username/email or password.";
        }
    } else {
        // Thiếu dữ liệu
        $_SESSION['error_message'] = "Please fill in all fields.";
    }
}

// Hiển thị thông báo (nếu có)
$successMessage = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);

$errorMessage = $_SESSION['error_message'] ?? '';
unset($_SESSION['error_message']);

include '../templates/login.html.php';
?>
