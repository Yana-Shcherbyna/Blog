<?php 
// підключаємо базу даних 
require_once('../database.php');
// підключаємо файл який відповідає за роботу зі статтями
require_once('../models/articles.php');

// встановлюємо з"єднання з базою даних
$link = db_connect();

// якщо є вхідний параметр $_GET['action]
if (isset($_GET['action']))
// тоді змінна $action = масиву з ключем ['action'] 
  $action = $_GET['action'];
else
// тоді змінна $action = пуста
  $action = "";

// якщо $action = додати
if ($action == "add") {


  // додати нову статтю, пост !!!!!!!потрібне пояснення!!!!!
  if (!empty($_POST)) {
    articles_new($link, $_POST['title'], $_POST['date'], $_POST['content']);
    // перенаправлення користувача на index.php
      header("Location: index.php");
  }

// порібно завантажити шаблон який дозволяє додати нову статтю
include("../views/article_newadmin.php");
} 
// якщо вхідний параметр == edit
else if ($action == "edit") {

  // перевіряємо, якщо не встановлений параметр ID
  if (!isset($_GET['id']))
  // то перенапрвляємо користувача на головну сторінку адмінки
  header("Location: index.php");
  // якщо параметр ID заданий($_GET['id']), то його конвертуємо в INT(число). Якщо даний параметр виявився строкою, то таке перетворення видасть "0"
  $id = (int)$_GET['id'];

  // перевіряємо, якщо параметер POST не пустий і $id більше "0"
  if (!empty($_POST) && $id > 0) {
    // тоді потрібно зберегти дану статтю (пост)
    // $link - з"єднання з базою даних
    // $id - передаємо ID
    // $_POST[...] - передаємо нові дані
    articles_edit($link, $id, $_POST['title'], $_POST['date'], $_POST['content']);
    // після того як, дані будуть збережені в базі даних, робимо переадресацію на нову сторінку
    header("Location: index.php");
  }

   
    // якщо, $_POST дані порожні, потрібно відобразити таблицю зі змістом пустими полями доступними для редагування. Попередня секція буде ігноруватись
    // отримуємо статтю з бази даних
    $article = articles_get($link, $id);
    // і підключаємо сторінку яка відповідає за статтю
    include("../views/article_admin.php");
}

// для видалення статтей (постів)
else if ($action == "delete") {
  // тоді присвоюєм параметр GET['id']
  $id = $_GET['id'];
  // визиваємо функцію в яку передаємо з"єднання з базою ($link) та $id яку ми хочемо видалити
  $articles = articles_delete($link, $id);
  // редірект на головну
  header("Location: index.php");

}


// якщо ніяких параметрів не передано, використовуємо шаблон для виводу всіх статтей блогу
else {  
// робимо запит до бази даних, щодо статтей які доступні в блозі для читання (з єдиним параметром "дискриптор $link")
$articles = articles_all($link);

// підключимо файл в якому буде відображатись front адмінки
include('../views/articles_admin.php');
}

?>