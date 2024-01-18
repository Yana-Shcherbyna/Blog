<?php
define('MYSQL_SERVER', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', 'blog');

function db_connect() {

  //connect to the database (connection handle)
  $link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
  // if the connection is not established, it gives an error
    or die('Error: ' . mysqli_error($link));

// set the coding
  if (!mysqli_set_charset($link, 'utf8mb4')) {
    printf('Error: ' . mysqli_error($link));
  }

  return $link;
}
