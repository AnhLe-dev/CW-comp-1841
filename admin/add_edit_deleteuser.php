<?php
try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    // Lấy user để chỉnh sửa nếu có
    if (isset($_GET['edit'])) {
        $edituser = getUserById($pdo, $_GET['edit']);
    }

    // Xử lý form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Thêm user
        if (isset($_POST['add_user'])) {
            if (!empty($_POST['nameStudent']) && !empty($_POST['password'])) {
                addUser($pdo, $_POST['nameStudent'], $_POST['email'], $_POST['password']);
                header('Location: add_edit_deleteuser.php?success=User added successfully');
                exit();
            } else {
                header('Location: add_edit_deleteuser.php?error=Name and password are required');
                exit();
            }
        }

        // Cập nhật user
        if (isset($_POST['update_user'])) {
            if (empty($_POST['nameStudent'])) {
                header('Location: add_edit_deleteuser.php?error=Name is required&edit=' . $_POST['id']);
                exit();
            }

            updateUser($pdo, $_POST['id'], $_POST['nameStudent'], $_POST['email'], $_POST['password'] ?? null);
            header('Location: add_edit_deleteuser.php?success=User updated successfully');
            exit();
        }

        // Xoá user
        if (isset($_POST['delete_user'])) {
            $count = countPostsByUser($pdo, $_POST['id']);
            if ($count == 0) {
                deleteUser($pdo, $_POST['id']);
                header('Location: add_edit_deleteuser.php?success=User deleted successfully');
            } else {
                header('Location: add_edit_deleteuser.php?error=' . urlencode("Cannot delete user because they have {$count} post(s)."));
            }
            exit();
        }
    }

    // Lấy danh sách user để hiển thị
    $users = allUsers($pdo);
    $title = 'User Management';

    // Xử lý message thông báo
    $successMessage = $_GET['success'] ?? '';
    $errorMessage = $_GET['error'] ?? '';

    ob_start();
    include 'templates/add_edit_deleteuser.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
