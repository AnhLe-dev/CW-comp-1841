<?php
 function query($pdo, $sql, $parameters = []){
   $query = $pdo->prepare($sql);
   $query->execute($parameters);
   return $query;
 }

// Post
 function totalPosts($pdo){
    $query = $pdo->prepare('SELECT COUNT(*) FROM post');
    $query->execute();
    $row = $query->fetch();
    return $row[0]; 
 }

  function allPosts($pdo){
   $posts = query($pdo, 'SELECT post.id, post.postQuestion, post.date, post.uploads, 
     users.nameStudent, users.id as userid, module.nameModule 
     FROM post
     INNER JOIN users ON post.userid = users.id
     INNER JOIN module ON post.moduleid = module.id 
     ORDER BY post.date DESC');
     return $posts->fetchAll(); 
 }

  function getPost($pdo, $id){
   $parameters = [':id' => $id];
   $query = query($pdo, 'SELECT post.*, users.nameStudent, module.nameModule, users.id as userid, module.id as moduleid 
  FROM post 
   INNER JOIN users ON post.userid = users.id 
   INNER JOIN module ON post.moduleid = module.id 
   WHERE post.id = :id', $parameters);
   return $query->fetch();
 }

  function deletePost($pdo, $id) {
   $parameters = [':id' => $id];
   query($pdo, 'DELETE FROM post WHERE id =:id', $parameters);
 }
 
 function insertPost($pdo, $postQuestion, $fileToUpload, $userid, $moduleid){
   $query = 'INSERT INTO post (postQuestion, `date`,`uploads`, userid, moduleid)
   VALUES (:postQuestion, CURDATE(), :fileToUpload, :userid, :moduleid)';
   $parameters = [':postQuestion' => $postQuestion, ':fileToUpload' =>$fileToUpload, ':userid' => $userid, ':moduleid' => $moduleid];
   query($pdo, $query, $parameters);
 }

 function updatePost($pdo, $postid, $postQuestion, $uploads = null){
   if ($uploads !== null) {
     $query = 'UPDATE post SET postQuestion = :postQuestion, uploads = :uploads WHERE id = :id';
     $parameters = [':postQuestion' => $postQuestion, ':uploads' => $uploads, ':id'=> $postid];
   } else {
     $query = 'UPDATE post SET postQuestion = :postQuestion WHERE id = :id';
     $parameters = [':postQuestion' => $postQuestion, ':id'=> $postid];
   }
   query($pdo, $query, $parameters);
 } 

function getPostsByUser($pdo, $userId) {
    $query = 'SELECT post.id, post.postQuestion, post.date, post.uploads, 
                users.nameStudent, module.nameModule 
              FROM post
              INNER JOIN users ON post.userid = users.id
              INNER JOIN module ON post.moduleid = module.id 
              WHERE post.userid = :userid
              ORDER BY post.date DESC';
    $parameters = [':userid' => $userId];
    $stmt = query($pdo, $query, $parameters);
    return $stmt->fetchAll();
}

// User
 function allUsers($pdo){
   $users = query($pdo, 'SELECT * FROM users');
   return $users->fetchAll();
 }

 function updateUserAndModule($pdo, $postId, $userId, $moduleId,) {
  $query = 'UPDATE post SET userid = :userid, moduleid = :moduleid WHERE id = :id';
  $parameters = [':userid' => $userId, ':moduleid' => $moduleId, ':id' => $postId];
  query($pdo, $query, $parameters);
}

function getUserById($pdo, $id) {
    $sql = 'SELECT * FROM users WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

function addUser($pdo, $nameStudent, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (nameStudent, email, password) VALUES (:nameStudent, :email, :password)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nameStudent' => $nameStudent,
        'email' => $email ?? '',
        'password' => $hashedPassword
    ]);
}

function updateUser($pdo, $id, $nameStudent, $email, $password = null) {
    $sql = 'UPDATE users SET nameStudent = :nameStudent, email = :email';
    $params = [
        'nameStudent' => $nameStudent,
        'email' => $email ?? '',
        'id' => $id
    ];

    if (!empty($password)) {
        $sql .= ', password = :password';
        $params['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql .= ' WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}

function deleteUser($pdo, $id) {
    $sql = 'DELETE FROM users WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

function countPostsByUser($pdo, $userId) {
    $sql = 'SELECT COUNT(*) FROM post WHERE userid = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $userId]);
    return $stmt->fetchColumn();
}


// Module
 function allModule($pdo){
   $modules = query($pdo, 'SELECT * FROM module');
   return $modules->fetchAll();
 }

function getAllModules($pdo) {
    $sql = 'SELECT * FROM module ORDER BY nameModule';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

 function getModuleById($pdo, $id) {
    $sql = 'SELECT * FROM module WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(); // Trả về 1 dòng dữ liệu dạng mảng kết hợp
}

function addModule($pdo, $nameModule) {
    $sql = 'INSERT INTO module (nameModule) VALUES (:nameModule)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['nameModule' => $nameModule]);
}

function updateModule($pdo, $id, $nameModule) {
    $sql = 'UPDATE module SET nameModule = :nameModule WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nameModule' => $nameModule,
        'id' => $id
    ]);
}

function countPostsUsingModule($pdo, $id) {
    $sql = 'SELECT COUNT(*) FROM post WHERE moduleId = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetchColumn();
}

function deleteModule($pdo, $id) {
    $sql = 'DELETE FROM module WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

 //feedback message
function allmessage($pdo) {
    $query = 'SELECT user_message.id, feedback_message, users.nameStudent AS usname, email 
              FROM user_message 
              INNER JOIN users ON user_id = users.id';
    $messages = query($pdo, $query);
    return $messages->fetchAll();
}

function totalmessage($pdo){
    $query = $pdo->prepare('SELECT COUNT(*) FROM user_message');
    $query->execute();
    $row = $query->fetch();
    return $row[0];
}

function insertmessage($pdo, $feedback_message,$user_id) {
    $query = 'INSERT INTO user_message (feedback_message,user_id) VALUES (:feedback_message,:user_id)';
    $parameters = [':feedback_message' => $feedback_message,'user_id' => $user_id];
    query($pdo, $query, $parameters);
}









function deletelistcontact($pdo, $id){
    $query = 'DELETE FROM user_message WHERE id = :id';
    $parameters = [':id' => $id];
    query($pdo, $query, $parameters);
}