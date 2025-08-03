<?php
require "login/Check.php";
try{
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    $posts = allPosts($pdo);
    $title = 'Question list';
    $totalposts = totalPosts($pdo);


    ob_start();
    include 'templates/posts.html.php';

    $output = ob_get_clean();
    }catch (PDOException $e){
        $title = 'An error has occured';
        $output = 'Database error: ' . $e->getMessage(); 
    }
    include 'templates/layout.html.php';