<?php
session_start();
if(isset($_POST['submit'])){
    try{
        include '../include/DatabaseConnection.php';
        include '../include/DatabaseFunctions.php';

        // Handle file upload
        $uploadFile = '';
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['name'] !== '') {
            if ($_FILES['fileToUpload']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Upload error');
            }

            $target_dir = "../uploads/";
            $uploadDir = '../uploads/';
            // Generate unique filename
            $fileInfo = pathinfo($_FILES['fileToUpload']['name']);
            $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';
            $uploadFile = uniqid() . $extension;
            $targetPath = $uploadDir . $uploadFile;
            
            // Try to move the uploaded file
            if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetPath)) {
                $error = error_get_last();
                throw new Exception('Failed to move uploaded file. Error: ' . ($error['message'] ?? 'Unknown error'));
            }
        }

        // Insert post into database
        insertPost($pdo, $_POST['postQuestion'], $uploadFile, $_POST['users'], $_POST['module']);
        header('location: posts.php');
        exit();
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    } catch (Exception $e) {
        $title = 'An error has occurred';
        $output = 'Upload error: ' . $e->getMessage();
    }
} else {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';
    $title = "Add a new post";
    $users = allUsers($pdo);
    $modules = allModule($pdo);
    ob_start();
    include 'templates/addposts_admin.html.php';
    $output = ob_get_clean();
}
include 'templates/layout.html.php';