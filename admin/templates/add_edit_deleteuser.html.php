<div class="user-management">
    <h2 class="page-title">User Management</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['success']) ?>
        </div>
    <?php endif; ?>

    <!-- Add/Edit User Form -->
    <div class="form-container">
        <form method="post" action="" class="user-form">
            <?php if (isset($edituser)): ?>
                <h3>Edit User</h3>
                <input type="hidden" name="id" value="<?= htmlspecialchars($edituser['id']) ?>">
            <?php else: ?>
                <h3>Add New User</h3>
            <?php endif; ?>
            
            <div class="form-group">
                <label for="nameStudent">Student Name</label>
                <input type="text" 
                       name="nameStudent" 
                       id="nameStudent" 
                       required 
                       placeholder="Enter student name"
                       value="<?= isset($edituser) ? htmlspecialchars($edituser['nameStudent']) : '' ?>">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       required
                       placeholder="Enter email address"
                       value="<?= isset($edituser) ? htmlspecialchars($edituser['email']) : '' ?>">
            </div>

            <div class="form-group">
                <label for="password">
                    <?= isset($edituser) ? 'New Password (leave blank to keep current)' : 'Password' ?>
                </label>
                <input type="password" 
                       name="password" 
                       id="password" 
                       <?= !isset($edituser) ? 'required' : '' ?>
                       placeholder="<?= isset($edituser) ? 'Leave blank to keep current password' : 'Enter password' ?>">
                <?php if (isset($edituser)): ?>
                    <small class="help-text">Only fill this if you want to change the password</small>
                <?php endif; ?>
            </div>

            <div class="form-actions">
                <?php if (isset($edituser)): ?>
                    <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                    <a href="add_edit_deleteuser.php" class="btn btn-secondary">Cancel</a>
                <?php else: ?>
                    <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Users List -->
    <div class="users-list">
        <h3>Existing Users</h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="3" class="text-center">No users found</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['nameStudent']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td class="actions">
                                    <a href="?edit=<?= $user['id'] ?>" class="btn-edit">Edit</a>
                                    <form method="post" action="" class="delete-form" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                        <button type="submit" name="delete_user" class="btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.user-management {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.page-title {
    color: #333;
    margin-bottom: 30px;
    font-size: 24px;
}

/* Alert Styles */
.alert {
    padding: 12px 20px;
    border-radius: 4px;
    margin-bottom: 20px;
    font-weight: 500;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Form Styles */
.form-container {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.user-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    max-width: 500px;
}

.user-form h3 {
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-weight: 500;
    color: #333;
}

.form-group input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.1);
}

.help-text {
    color: #666;
    font-size: 12px;
    margin-top: 4px;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

/* Button Styles */
.btn-primary {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #0056b3;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #6c757d;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #5a6268;
    transform: translateY(-1px);
}

/* Table Styles */
.users-list {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.users-list h3 {
    color: #333;
    margin-bottom: 20px;
}

.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #333;
}

td {
    color: #666;
}

.actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.btn-edit {
    background: #28a745;
    color: white;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-edit:hover {
    background: #218838;
    transform: translateY(-1px);
}

.btn-delete {
    background: #dc3545;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background: #c82333;
    transform: translateY(-1px);
}

.delete-form {
    display: inline;
}

.text-center {
    text-align: center;
}
</style>