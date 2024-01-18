<?php
// echo 'Hello word from PHP';
// // echo time();
// function add($param1, $param2) {
//   return $param1 + $param2;
// }
// $a = $_GET['a'];
// $b = $_GET['b'];

// echo add($a, $b);

// echo '<br>';

// for ($i = 0; $i < 10; $i++) {
//   echo $i . '<br>';
// }

// підключаємо файл який взаємодіє з базою даних
require_once('database.php');
// файл який працює зі статтями
require_once('models/articles.php');

// з"єднаємось з базою даних
$link = db_connect();
// робимо запрос до бази даних, про повернення всіх статтей для перегляду (вводимо параметр дискриптор $link)
$articles = articles_all($link);

// підключаємо використовуємий шаблон
include('views/articles.php');

?>