<?php
session_start();

include '../include/DatabaseConnection.php';
include '../include/DatabaseFunctions.php';

try {
    // Check if we have a post ID
    if (!isset($_GET['id']) && !isset($_POST['postid'])) {
        header('location: posts.php');
        exit();
    }

    $postId = $_GET['id'] ?? $_POST['postid'];

    if (isset($_POST['submit'])) {
        // Validate input
        if (empty($_POST['postQuestion'])) {
            throw new Exception('Question cannot be empty');
        }

        $uploadedImage = null;
        // Handle image upload if a new file is selected
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] > 0) {
            $target_dir = "../uploads/";
            $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
            $newFileName = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $newFileName;


            // Allow certain file formats
            if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                throw new Exception('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
            }

            // Delete old image if exists
            if (!empty($post['uploads'])) {
                $oldFile = $target_dir . $post['uploads'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                throw new Exception('Sorry, there was an error uploading your file.');
            }

            $uploadedImage = $newFileName;
        }

        // Update post
        updatePost($pdo, $_POST['postid'], $_POST['postQuestion'], $uploadedImage);
        updateUserAndModule($pdo, $_POST['postid'], $_POST['users'] , $_POST['module']);
        // $_POST['users']
        header('location: posts.php?success=Post updated successfully');
        exit();
    }

    // Get post data for editing
    $post = getPost($pdo, $postId);
    if (!$post) {
        header('location: posts.php?error=Post not found');
        exit();
    }

    $users = allUsers($pdo);
    $modules = allModule($pdo);
    $title = 'Edit Question';

    ob_start();
    include 'templates/editposts.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error has occurred';
    $output = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'Error has occurred';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';
