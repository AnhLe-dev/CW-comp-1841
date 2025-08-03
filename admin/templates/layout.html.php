<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="stylesheet" href="./cw.css">
    <title>Welcome to Question Web</title>
</head>
<body>
    <header id="admin">
        <h1>Admin Dashboard<br />
        Manage Questions, Modules and Students </h1></header>
    <nav>
        <ul>
           
            <li><a href="posts.php">Question List </a></li>
            ali><a href="addpost_admin.php">Add a new question</a></li>
             <li><a href="add_edit_deleteuser.php">Manage user</a></li>
            <li><a href="add_edit_deletemodule.php">Manage module</a></li>
             <li><a href="Feedback_process.php">Message from user</a></li>
            <li><a href="../index.php">Logout</a></li> 
        </ul>
    </nav>
    <main>
        <?=$output?>
    </main>
    <footer>&copy; DucAnh</footer>
</body>
</html>