<?php if (isset($error)): ?>
    <div class="error-message"><?=$error?></div>
<?php endif; ?>

<?php if (isset($success)): ?>
    <div class="success-message"><?=$success?></div>
<?php endif; ?>

<div class="questions-list">
    <div class="questions-header">
        <h2>Questions List</h2>
        <?php if (isset($_SESSION['loggedin'])): ?>
            <a href="addpost.php" class="add-post-btn">Add New Question</a>
        <?php endif; ?>
    </div>
    
    <p class="total-posts"><?=$totalposts?> Questions have been posted</p>

    <?php foreach($posts as $post): ?>
        <div class="question-card">
            <div class="question-content">
                <div class="question-meta">
                    <span class="date"><?=date("D d M Y", strtotime($post['date']))?></span>
                    <span class="module">Module: <?=htmlspecialchars($post['nameModule'], ENT_QUOTES, 'UTF-8')?></span>
                    <span class="student">Posted by: <?=htmlspecialchars($post['nameStudent'], ENT_QUOTES, 'UTF-8')?></span>
                </div>
                
                <div class="question-text">
                    <p><?=htmlspecialchars($post['postQuestion'], ENT_QUOTES, 'UTF-8')?></p>
                    <?php if (!empty($post['uploads'])): ?>
                        <div class="question-image">
                            <img src="../uploads/<?=htmlspecialchars($post['uploads'], ENT_QUOTES, 'UTF-8' )?>" style="width:200px;height:200px"; alt="Question Image">
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- <div class="question-actions">
                    <a href="editpost.php?id=<?=$post['id']?>" class="btn edit-btn">Edit</a>
                    <form action="deletepost.php" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?=$post['id']?>">
                        <input type="submit" class="btn delete-btn" value="Delete" onclick="return confirm('Are you sure you want to delete this question?');">
                    </form>
                </div> -->
            </div>
        </div>
    <?php endforeach; ?>
</div>

<style>
.questions-list {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.question-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    padding: 20px;
}

.question-meta {
    color: #666;
    font-size: 0.9em;
    margin-bottom: 10px;
}

.question-meta span {
    margin-right: 15px;
}

.question-text {
    margin: 15px 0;
}

.question-actions {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #eee;
    display: flex;
    gap: 10px;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    cursor: pointer;
    border: none;
    transition: background-color 0.2s;
}

.edit-btn {
    background-color: #007bff;
    color: white;
}

.edit-btn:hover {
    background-color: #0056b3;
    color: white;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
}

.delete-btn:hover {
    background-color: #c82333;
    color: white;
}

.add-post-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 20px;
}

.add-post-btn:hover {
    background-color: #218838;
    color: white;
}

.questions-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.total-posts {
    color: #666;
    margin-bottom: 20px;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}
</style>