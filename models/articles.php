<?php

// for data from the database
function articles_all($link) {
  // database query
  $query = 'SELECT * FROM articles ORDER BY id DESC';
  $result = mysqli_query($link, $query);

  // if there is an error, then we suspend the script and display an error
  if (!$result) 
    die(mysqli_error($link));

    // we get the number of terms given by the database
    $n = mysqli_num_rows($result);
    $articles = array();

    // we go through each term of the table 
    for ($i = 0; $i < $n; $i++) {

      // we create an associative array of strings from the table
      $row = mysqli_fetch_assoc($result);
      $articles[] = $row;
    }

    return $articles;
}

// get articles (records) 
function articles_get($link, $id_articles) {

  $query = sprintf('SELECT * FROM articles WHERE id=%d', (int)$id_articles);
  $result = mysqli_query($link, $query);

  // if the request is not fulfilled, we report an error
  if (!$result)
    die(mysqli_error($link));

  // we get the result in the form of an associative array
  $article = mysqli_fetch_assoc($result);
  
  return $article;
}

// add new article
function articles_new($link, $title, $date, $content) {

  // PREPARATION
  // remove spaces at the beginning and at the end, if they are present
  $title = trim($title);
  $content = trim($content);

  // AUDIT
  if ($title == "") 
    return false;

  // SQL QUERY
  $t = "INSERT INTO articles (title, date, content) VALUES ('%s', '%s', '%s')";

  // we form the term of the request
  $query = sprintf($t, mysqli_real_escape_string($link, $title), mysqli_real_escape_string($link, $date), mysqli_real_escape_string($link, $content));

  // perform a query to the database
    $result = mysqli_query($link, $query);

  // if there is an error, then we suspend the script and display an error
    if (!$result)
      die(mysqli_error($link));
    return true;
}

// edit articles
function articles_edit($link, $id, $title, $date, $content) {
  
  // PREPARATION
  // remove spaces at the beginning and at the end, if they are present
  $title = trim($title);
  $content = trim($content);
  $date = trim($date);
  // convert the ID into an integer
  $id = (int)$id;

  // AUDIT
  if ($title == "") 
    return false;

  // SQL QUERY
  $sql = "UPDATE articles SET title='%s', content='%s', date='%s' WHERE id='%d'";
  
  // we form the term of the request
  $query = sprintf($sql, 
  //this function escapes the input parameters, i.e. adds a backslash before those characters that can spoil the SQL query 
  mysqli_real_escape_string($link, $title), // 1st parameter
  mysqli_real_escape_string($link, $content), // 2nd parameter
  mysqli_real_escape_string($link, $date), // 3rd parameter
  $id); // 4th parameter

  // execution of SQL query
  $result = mysqli_query($link, $query);

  // if there is an error, then we suspend the script and display an error
  if (!$result)
    die(mysqli_error($link));

  // if it passed without errors, then we return the number of articles whose term was successfully edited
  return mysqli_affected_rows($link);
  
}

// delete articles
function articles_delete($link, $id) {
  // convert the ID into an integer
  $id = (int)$id;

  // AUDIT
  if ($id == 0) 
    return false;

  //SQL QUERY
  $query = sprintf("DELETE FROM articles WHERE id='%d'", $id);
  $result = mysqli_query($link, $query);

  // if there is an error, then we suspend the script and display an error
  if (!$result)
    die(mysqli_error($link));
  return mysqli_affected_rows($link);
}

// function for shortening the text of the post
function articles_intro($text, $len = 500) {
// a function that returns part of a string
// $text - copies the text; "0" - starting from the zero position; $len - length (which is specified in this parameter)
return mb_substr($text, 0, $len);
}

?>
