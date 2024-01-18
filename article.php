<?php 

require_once('database.php');
require_once('models/articles.php');

// встановлюємо з"єднання з базою даних
$link = db_connect();
// передаємо дискриптор з"єднання
$article = articles_get($link, $_GET['id']);

include('views/article.php');

?>