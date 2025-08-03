<?php if (isset($error)): ?>
    <div class="error-message"><?=$error?></div>
<?php endif; ?>

<div class="add-post-container">
    <h2>Add New Question</h2>
    
    <form action="" method="post" enctype="multipart/form-data" class="add-post-form">
        <div class="form-group">
            <label for="postQuestion">Question:</label>
            <textarea id="postQuestion" name="postQuestion" class="form-control" rows="5" required 
                      placeholder="Write your question here..."></textarea>
        </div>

        <div class="form-group">
            <label for="fileToUpload">Upload Image (optional):</label>
            <input type="file" id="fileToUpload" name="fileToUpload" class="form-control" accept="image/*">
            <small class="form-text">Supported formats: JPG, PNG, GIF</small>
        </div>

        <div class="form-group">
            <label for="module">Module:</label>
            <select id="module" name="module" class="form-control" required>
                <option value="">Select a module</option>
                <?php foreach ($modules as $module): ?>
                    <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8')?>">
                        <?=htmlspecialchars($module['nameModule'], ENT_QUOTES, 'UTF-8')?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- <div class="form-group">
            <label for="users">User:</label>
            <select id="users" name="users" class="form-control" required>
                <option value="">Select a user</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8')?>">
                        <?=htmlspecialchars($user['nameStudent'], ENT_QUOTES, 'UTF-8')?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div> -->

        <div>
            <button type="submit" name="submit" class="submit-btn">
                <i class="fas fa-plus"></i> Add Question
            </button>
            <a href="posts.php" class="cancel-btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>

<style>
.add-post-container {

    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.add-post-container h2 {
    margin-bottom: 20px;
    color: #333;
}

.add-post-form {
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.2s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.form-text {
    display: block;
    margin-top: 5px;
    font-size: 14px;
    color: #6c757d;
}



.submit-btn, .cancel-btn {
    display: inline-flex;
    align-items: center;
    padding: 10px 20px;
    border-radius: 4px;
    border: none;
    cursor: none;
    font-size: 16px;
    text-decoration: none;
    
}

.submit-btn {
    background-color: #28a745;
    color: white;
}

.submit-btn:hover {
    background-color: #218838;
}

.cancel-btn {
    background-color: #6c757d;
    color: white;
}

.cancel-btn:hover {
    background-color: #5a6268;
}

.submit-btn i, .cancel-btn i {
    margin-left: 3px;
}

.error-message {
    background: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
}
</style>
