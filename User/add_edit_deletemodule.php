<?php
session_start();
try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';


   $modules = getAllModules($pdo);
    $title = 'Module Management';

    ob_start();
    include 'templates/add_edit_deletemodule.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';