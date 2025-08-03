<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="../cw.css">
    <title>Student Web</title>
</head>
<body>
    <header><h1>Student Forum</h1></header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="posts.php">Question List </a></li>
            <li><a href="my_question.php">My question</a></li>
            <li><a href="addpost.php">Add a new question</a></li> 
            <li><a href="add_edit_deletemodule.php">Module</a></li>
            <li><a href="Feedback.php">Feedback</a></li>
            <li><a href="../index.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <?=$output?>
    </main>
    <footer>&copy; By DucAnh</footer>
</body>
</html>