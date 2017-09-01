<?php

/*
  Database Information Script
  Only for me
 */


//The main programming language that will be used here will be
//PHP-PDO to connect to mysql database system for my website


try {
    //creating database connection
    $dataBase = new PDO(DATABASE_SERVER, DATABASE_USER, DATABASE_PASS);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>