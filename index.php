<?php
$title = 'Internet Joke Database';
ob_start();
include 'Guest/home.html.php';
$output = ob_get_clean();
include 'Guest/layout.html.php';