<?php

error_reporting(0);

//Composer Autoloader
require_once __DIR__ . "/vendor/autoload.php";

require_once "class/config.php";
require_once "class/db.php";

//Checking action
//Image Uploading
if ($_REQUEST['action'] === 'uploadImage') {
    $p = new \ITBLOG\Post($dataBase);
    header('Content-Type: application/json');
    echo json_encode($p->uploadImage());
}

//Blog Posting
if ($_REQUEST['action'] === 'Publish') {
    $post = new \ITBLOG\Post($dataBase);

    //Saving the post
    $post->uploadPost();
}