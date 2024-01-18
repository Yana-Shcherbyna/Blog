<?php

// add connecting with DataBase
require_once('database.php');
// add articles file 
require_once('models/articles.php');

$link = db_connect();
// we make a request to the database to return all articles for review (enter the $link descriptor parameter)
$articles = articles_all($link);

// connect the used template
include('views/articles.php');

?>
