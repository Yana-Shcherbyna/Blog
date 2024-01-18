<?php
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'blog');

function db_connect() {

  // під"єднуємось до бази даних (дискриптор з"єднання)
  $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)

  // якщо з"єднання не встановлено, видає помилку
    or die('Error: ' . mysqli_error($link));

// виставляємо кодування
  if (!mysqli_set_charset($link, 'utf8mb4')) {
    printf('Error: ' . mysqli_error($link));
  }

  return $link;
}
