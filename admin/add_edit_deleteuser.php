<?php
try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    // Handle GET request for edit
    if (isset($_GET['edit'])) {
        $sql = 'SELECT * FROM users WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $_GET['edit']]);
        $edituser = $stmt->fetch();
    }

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_user'])) {
            // Add new user
            if (!empty($_POST['nameStudent']) && !empty($_POST['password'])) {
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = 'INSERT INTO users (nameStudent, email, password) VALUES (:nameStudent, :email, :password)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'nameStudent' => $_POST['nameStudent'],
                    'email' => $_POST['email'] ?? '',
                    'password' => $hashedPassword
                ]);
                header('Location: add_edit_deleteuser.php?success=User added successfully');
                exit();
            } else {
                header('Location: add_edit_deleteuser.php?error=Name and password are required');
                exit();
            }
        } else if (isset($_POST['update_user'])) {
            // Validate required fields
            if (empty($_POST['nameStudent'])) {
                header('Location: add_edit_deleteuser.php?error=Name is required&edit=' . $_POST['id']);
                exit();
            }

            // Update user
            $sql = 'UPDATE users SET nameStudent = :nameStudent, email = :email';
            $parameters = [
                'nameStudent' => $_POST['nameStudent'],
                'email' => $_POST['email'] ?? '',
                'id' => $_POST['id']
            ];

            // Only update password if a new one is provided
            if (!empty($_POST['password'])) {
                $sql .= ', password = :password';
                $parameters['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }

            $sql .= ' WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($parameters);
            
            header('Location: add_edit_deleteuser.php?success=User updated successfully');
            exit();
        } else if (isset($_POST['delete_user'])) {
            // Check if user has any posts
            $checkSql = 'SELECT COUNT(*) FROM post WHERE userid = :id';
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->execute(['id' => $_POST['id']]);
            $count = $checkStmt->fetchColumn();

            if ($count == 0) {
                // Delete user if they have no posts
                $sql = 'DELETE FROM users WHERE id = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $_POST['id']]);
                header('Location: add_edit_deleteuser.php?success=User deleted successfully');
            } else {
                header('Location: add_edit_deleteuser.php?error=' . urlencode("Cannot delete user because they have {$count} post(s)."));
            }
            exit();
        } else if (isset($_POST['edit_user'])) {
            // Get user details for editing
            $sql = 'SELECT * FROM users WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $_POST['id']]);
            $edituser = $stmt->fetch();
        }
    }

    $users = allUsers($pdo);
    $title = 'User Management';

    ob_start();
    include 'templates/add_edit_deleteuser.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
include 'templates/layout.html.php';
