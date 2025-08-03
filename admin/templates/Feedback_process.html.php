<p><?=$totalmessages?> messages have been submitted .</p>

<?php foreach ($messages as $message) : ?>
     <blockquote>
           <strong>By:</strong>
         <?= htmlspecialchars($message['usname'], ENT_QUOTES, 'UTF-8') ?>
<br>
         <strong>Email:</strong>
         <?= htmlspecialchars($message['email'], ENT_QUOTES, 'UTF-8'); ?><br>
         <strong>Message:</strong>
         <?= htmlspecialchars($message['feedback_message'], ENT_QUOTES, 'UTF-8'); ?>
        <form action="Feedback_process.php" method="post">
            <input type="hidden" name="delete_id" value="<?= $message['id'] ?>">
            <input type="submit" value="Delete">
        </form>
     </blockquote>
<?php endforeach; ?>

