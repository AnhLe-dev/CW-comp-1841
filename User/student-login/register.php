<?php
// register.php
session_start();
include '../../include/DatabaseConnection.php';

if (isset($_POST['register'])) {
    $nameStudent = $_POST['nameStudent'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($nameStudent) && !empty($email) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (nameStudent, email, password) 
                                    VALUES (:nameStudent, :email, :password)");
            $stmt->bindParam(':nameStudent', $nameStudent);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Account created successfully!";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['error_message'] = "Registration failed.";
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error_message'] = "Please fill in all fields.";
    }
}

$successMessage = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);

$errorMessage = $_SESSION['error_message'] ?? '';
unset($_SESSION['error_message']);

include '../templates/register.html.php';
?>
