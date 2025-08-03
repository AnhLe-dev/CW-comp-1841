<?php
require "login/Check.php";

try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    // Nếu có yêu cầu xóa
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        deletelistcontact($pdo, $_POST['delete_id']);
        header('Location: Feedback_process.php');
            exit(); 
    }

    // Lấy danh sách và tổng số message
    $messages = allmessage($pdo);
    $title = 'Contact List';
    $totalmessages = totalmessage($pdo);

    ob_start();
    include 'templates/Feedback_process.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
