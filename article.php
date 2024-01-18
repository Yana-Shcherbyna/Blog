<?php 

require_once('database.php');
require_once('models/articles.php');

// establish a connection with the database
$link = db_connect();
// pass the connection descriptor
$article = articles_get($link, $_GET['id']);

include('views/article.php');

?>
