<?php
//namespace ITBLOG\CONFIG;
//This is a configuration file for ITBLOG
//This is the configuration which set the values needed for the blog.
//Setting current mode for the blog
//-development : Under development on localhost
//-production : Uploaded on the web.

define('FTP_PASS', 'u8Zw.ab(8Q&7');

define('MODE', 'development');
//define('MODE', 'production');
if (MODE === 'development') {
    define('APP_ADD', $_SERVER['REQUEST_SCHEME'] . "://itblog.dev/");
    define('DATABASE_HOST', 'localhost');
    define('DATABASE_USER', 'itblog');
    define('DATABASE_PASS', 'jsdh8asdd');
    define('DATABASE_NAME', 'itblog');
    define('DATABASE_SERVER', 'mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . '');
} elseif (MODE === 'production') {
//    define('APP_ADD', $_SERVER['REQUEST_SCHEME'] . "://itblog.com.ng/");
    define('APP_ADD', "http://itblog.com.ng/");
    define('DATABASE_HOST', 'itblog.com.ng');
    define('DATABASE_NAME', 'itblogco_db');
    define('DATABASE_USER', 'itblogco');
    define('DATABASE_PASS', 'rn5C3m3m7W');
    define('DATABASE_SERVER', 'mysql:host=' . DATABASE_HOST . ';port=3306;dbname=' . DATABASE_NAME . '');
}
define('PAGE_TITLE', 'ITBlog - The Information Technology Blog');
define('PAGE_DESCRIPTION', "The Information Technology blog which provide the required information from the tech industry and trending updates from the web.");
define('APP_NAME', 'ITBLOG');
define('APP_IMAGE', APP_ADD . 'images/logo.png');
define('APP_ADMIN_MAIL', 'mail@itblog.com.ng');
