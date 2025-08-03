<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    $userId = $_SESSION['user_id'];
    $posts = getPostsByUser($pdo, $userId);
    $totalposts = totalPosts($pdo);
    $title = 'My Questions';

    ob_start();
    include 'templates/my_questions.html.php'; 
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
