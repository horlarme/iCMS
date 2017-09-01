<?php

header('Content-Type: application/xml');
//Autoloading composer
require_once __DIR__ . "/vendor/autoload.php";

//Configuration file and Database
require_once 'class/config.php';
$dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);

//Connecting to sitemap class
$smap = new \ITBLOG\SiteMap($dataBase);

//Website address
$smap->site = "http://itblog.com.ng";

//The Database query
$smap->query = "SELECT `URL` FROM `postlist` WHERE `type` = 'published' ORDER BY `id` DESC";
//The category list
$smap->otherQuery = "SELECT `category_name` FROM `categories`";

//Creating the sitemap
$smap->createSiteMap();
?>