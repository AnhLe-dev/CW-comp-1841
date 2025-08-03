<?php
try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    // Handle GET request for edit
    if (isset($_GET['edit'])) {
        $sql = 'SELECT * FROM module WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $_GET['edit']]);
        $editmodule = $stmt->fetch();
    }

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_module'])) {
            // Add new module
            if (!empty($_POST['nameModule'])) {
                $sql = 'INSERT INTO module (nameModule) VALUES (:nameModule)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['nameModule' => $_POST['nameModule']]);
                header('Location: add_edit_deletemodule.php?success=Module added successfully');
                exit();
            } else {
                header('Location: add_edit_deletemodule.php?error=Module name is required');
                exit();
            }
        } else if (isset($_POST['update_module'])) {
            // Validate required fields
            if (empty($_POST['nameModule'])) {
                header('Location: add_edit_deletemodule.php?error=Module name is required&edit=' . $_POST['id']);
                exit();
            }

            // Update module
            $sql = 'UPDATE module SET nameModule = :nameModule WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nameModule' => $_POST['nameModule'],
                'id' => $_POST['id']
            ]);
            header('Location: add_edit_deletemodule.php?success=Module updated successfully');
            exit();
        } else if (isset($_POST['delete_module'])) {
            // Check if module is in use
            $checkSql = 'SELECT COUNT(*) FROM post WHERE moduleId = :id';
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute(['id' => $_POST['id']]);
            $count = $checkStmt->fetchColumn();

            if ($count == 0) {
                // Delete module if not in use
                $sql = 'DELETE FROM module WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
                header('Location: add_edit_deletemodule.php?success=Module deleted successfully');
            } else {
                header('Location: add_edit_deletemodule.php?error=' . urlencode("Cannot delete module because it is being used by {$count} post(s)."));
            }
            exit();
        } else if (isset($_POST['edit_module'])) {
            // Get module details for editing
            $sql = 'SELECT * FROM module WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_POST['id']]);
            $editmodule = $stmt->fetch();
        }
    }

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