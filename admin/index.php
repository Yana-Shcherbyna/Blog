<?php 
// connect the database 
require_once('../database.php');
// we connect the file responsible for working with articles
require_once('../models/articles.php');

// establish a connection with the database
$link = db_connect();


// check the input parameter $_GET['action']
if (isset($_GET['action']))
  $action = $_GET['action'];
else
  $action = "";


// add post
if ($action == "add") {

  if (!empty($_POST)) {
    articles_new($link, $_POST['title'], $_POST['date'], $_POST['content']);
    // redirecting the user to index.php
      header("Location: index.php");
  }
  
// download a template that allows you to add a new article
include("../views/article_newadmin.php");
} 

  
// edit a post
else if ($action == "edit") {

  // check if the ID parameter is not set
  if (!isset($_GET['id']))
  // then redirects the user to the main admin page
  header("Location: index.php");
 
  $id = (int)$_GET['id'];

  // audit
  if (!empty($_POST) && $id > 0) {

    articles_edit($link, $id, $_POST['title'], $_POST['date'], $_POST['content']);
   // we redirect to a new page
    header("Location: index.php");
  }
  // if $_POST data is empty, you need to display a table with empty editable fields. The previous section will be ignored
    // we get the article from the database
    $article = articles_get($link, $id);
    //connect the page corresponding to the article
    include("../views/article_admin.php");
}
  

// to delete articles (posts)
else if ($action == "delete") {
  // then assign the parameter GET['id']
  $id = $_GET['id'];
  // call the function to which we pass the connection to the base ($link) and the $id that we want to delete
  $articles = articles_delete($link, $id);
  // redirect to the main page
  header("Location: index.php");

}

// if no parameters are passed, we use the template to display all blog articles
else {  
//request to the DB regarding articles that are available on the blog for reading (with the only parameter "descriptor $link")
$articles = articles_all($link);

// connect the file in which the front of the admin will be displayed
include('../views/articles_admin.php');
}

?>
