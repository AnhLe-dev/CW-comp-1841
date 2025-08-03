<?php
session_start();
try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';


    // Get all modules
    $sql = 'SELECT * FROM module ORDER BY nameModule';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $modules = $stmt->fetchAll();
    
    $title = 'Module Management';

    ob_start();
    include 'templates/add_edit_deletemodule.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';