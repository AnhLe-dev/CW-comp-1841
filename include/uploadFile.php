<?php
$target_dir = "../uploads/";
$target_file = $target_dir . basenameStudent($_FILES["fileToUpload"]["nameStudent"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
