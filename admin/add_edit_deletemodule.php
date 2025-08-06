<?php
try {
    include '../include/DatabaseConnection.php';
    include '../include/DatabaseFunctions.php';

    // Lấy dữ liệu module nếu đang chỉnh sửa
    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
        $editmodule = getModuleById($pdo, $_GET['edit']);
    }

    // Xử lý form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Thêm mới
        if (isset($_POST['add_module'])) {
            if (!empty($_POST['nameModule'])) {
                addModule($pdo, $_POST['nameModule']);
                header('Location: add_edit_deletemodule.php?success=Module added successfully');
                exit();
            } else {
                header('Location: add_edit_deletemodule.php?error=Module name is required');
                exit();
            }
        }

        // Cập nhật
        if (isset($_POST['update_module'])) {
            if (empty($_POST['nameModule'])) {
                header('Location: add_edit_deletemodule.php?error=Module name is required&edit=' . $_POST['id']);
                exit();
            }

            updateModule($pdo, $_POST['id'], $_POST['nameModule']);
            header('Location: add_edit_deletemodule.php?success=Module updated successfully');
            exit();
        }

        // Xóa
        if (isset($_POST['delete_module'])) {
            $count = countPostsUsingModule($pdo, $_POST['id']);

            if ($count == 0) {
                deleteModule($pdo, $_POST['id']);
                header('Location: add_edit_deletemodule.php?success=Module deleted successfully');
            } else {
                header('Location: add_edit_deletemodule.php?error=' . urlencode("Cannot delete module because it is being used by {$count} post(s)."));
            }
            exit();
        }
    }

    // Lấy tất cả module
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
