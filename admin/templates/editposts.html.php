<div class="edit-post-container">
    <h2>Edit Question</h2>
    <form action="" method="post" enctype="multipart/form-data" class="edit-form">
        <input type="hidden" name="postid" value="<?=$post['id'];?>">
        
        <div class="form-group">
            <label for='postQuestion'>Question Content:</label>
            <textarea name="postQuestion" id="postQuestion" class="form-control" rows="5"><?=htmlspecialchars($post['postQuestion'], ENT_QUOTES, 'UTF-8')?></textarea>
        </div>

        <div class="form-group">
            <label>Current Image:</label>
            <?php if (!empty($post['uploads'])): ?>
                <div class="current-image">
                    <img src="../uploads/<?= htmlspecialchars($post['uploads'], ENT_QUOTES, 'UTF-8') ?>" alt="Post image" style="max-width: 200px;">
                </div>
            <?php else: ?>
                <p>No image currently attached</p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="fileToUpload">Upload New Image:</label>
            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="users">Select User:</label>
            <select name="users" id="users" class="form-control">
                <?php foreach ($users as $user): ?>
                    <option value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                        <?= $post['userid'] == $user['id'] ? 'selected' : '' ?>>
                        <?=htmlspecialchars($user['nameStudent'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="module">Select Module:</label>
            <select name="module" id="module" class="form-control">
                <?php foreach ($modules as $module): ?>
                    <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                        <?= $post['moduleid'] == $module['id'] ? 'selected' : '' ?>>
                        <?=htmlspecialchars($module['nameModule'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <button type="submit" name="submit" class="submit-btn">
                <i class="fas fa-save"></i> Save Changes
            </button>
            <a href="posts.php" class="cancel-btn">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>

<style>
.edit-post-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.edit-post-container h2 {
    margin-bottom: 20px;
    color: #333;
}

.edit-form {
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
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}



.submit-btn, .cancel-btn {
    display: inline-flex;
    align-items: center;
    padding: 10px 20px;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    transition: background-color 0.2s;
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
    margin-right: 5px;
}
</style>