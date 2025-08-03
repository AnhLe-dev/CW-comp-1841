<?php
session_start();
include '../include/DatabaseConnection.php';
include '../include/DatabaseFunctions.php';

if (isset($_POST['feedback_message']) && isset($_SESSION['user_id'])) {
    try {
        insertmessage($pdo, $_POST['feedback_message'], $_SESSION['user_id']);
        $output = 'Thank you to feedback.';
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
} else {
    $title = 'Feedback';
    ob_start();
    include 'templates/Feedback.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';
