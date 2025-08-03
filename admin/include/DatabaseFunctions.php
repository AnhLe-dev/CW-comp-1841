<?php
 function totalPosts($pdo){
    $query = $pdo->prepare('SELECT COUNT(*) FROM post');
    $query->execute();
    $row = $query->fetch();
    return $row[0]; 
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

 function query($pdo, $sql, $parameters = []){
   $query = $pdo->prepare($sql);
   $query->execute($parameters);
   return $query;
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

 function allUsers($pdo){
   $users = query($pdo, 'SELECT * FROM users');
   return $users->fetchAll();
 }

 function allModule($pdo){
   $modules = query($pdo, 'SELECT * FROM module');
   return $modules->fetchAll();
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

 function getAllFeedback($pdo) {
  $query = 'SELECT * FROM user_message ORDER BY time DESC';
  $feedback = query($pdo, $query);
  return $feedback->fetchAll();
}

function updateUserAndModule($pdo, $postId, $userId, $moduleId,) {
  $query = 'UPDATE post SET userid = :userid, moduleid = :moduleid WHERE id = :id';
  $parameters = [':userid' => $userId, ':moduleid' => $moduleId, ':id' => $postId];
  query($pdo, $query, $parameters);
}

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

function deletelistcontact($pdo, $id){
    $query = 'DELETE FROM user_message WHERE id = :id';
    $parameters = [':id' => $id];
    query($pdo, $query, $parameters);
}
