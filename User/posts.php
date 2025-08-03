<?php
session_start();
try{
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    $posts = allPosts($pdo);
    $users = allUsers($pdo);
    $module = allModule($pdo);
    $title = 'My questions';
    $totalposts = totalPosts($pdo);

    // Handle success and error messages
    if (isset($_GET['error'])) {
        $error = htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8');
    }
    if (isset($_GET['success'])) {
        $success = htmlspecialchars($_GET['success'], ENT_QUOTES, 'UTF-8');
    }

    ob_start();
    include 'templates/posts.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage(); 
}
include 'templates/layout.html.php';