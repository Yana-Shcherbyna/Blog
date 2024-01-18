<?php

//   //для статичних даних
// function articles_all() {
  // $art1 = [
  //   'id' => 1,
  //   'title' => 'First title',
  //   'date' => '07-12-2023',
  //   'content' => 'Content1'
  // ];
  // $art2 = [
  //   'id' => 2,
  //   'title' => 'Second title',
  //   'date' => '08-12-2023',
  //   'content' => 'Content2'
  // ];

  // $arr[0] = $art1;
  // $arr[1] = $art2;

  // return $arr;
// }

// для даних з бази даних
function articles_all($link) {
  // запит до бази даних (запитуєм всі з таблиці articles і сортуємо по порядку DESC)
  $query = 'SELECT * FROM articles ORDER BY id DESC';
  $result = mysqli_query($link, $query);

  // якщо помилка, то призупиняємо роботу скрипта і виводимо помилку
  if (!$result) 
    die(mysqli_error($link));

    // отримуємо кількість строк які віддає база даних
    $n = mysqli_num_rows($result);
    // створюємо пустий масив
    $articles = array();

    // перебираємо кожну строку таблиці 
    for ($i = 0; $i < $n; $i++) {

      // створюємо асоціативний масив(з ключами) строки з таблиці
      $row = mysqli_fetch_assoc($result);
      // додаємо його в масив $articles[]
      $articles[] = $row;
    }

    return $articles;
}



//   //для статичних даних
// function articles_get($id_articles) {
//   return [
//     'id' => 1,
//     'title' => 'There is a simple title',
//     'date' => '07-12-2023',
//     'content' => 'Here must be a content of post',
//   ];
// }


// для даних з бази даних по двом параметрам 
function articles_get($link, $id_articles) {
  // запит до бази даних (вибрати всі стовбці з таблиці articles, де id = (int)$id_articles )
  $query = sprintf('SELECT * FROM articles WHERE id=%d', (int)$id_articles);
  // виконуємо sql-запит
  $result = mysqli_query($link, $query);

  // якщо запрос не виконався повідомляємо про помилку
  if (!$result)
    die(mysqli_error($link));

  // отримуємо результат в вигляді асоціативного масиву
  $article = mysqli_fetch_assoc($result);

  // повертаємо масив
  return $article;
}

function articles_new($link, $title, $date, $content) {

  // ПІДГОТОВКА
  // прибираємо пробіли спочатку і вкінці trim(), якщо вони присутні
  $title = trim($title);
  $content = trim($content);

  // ПЕРЕВІРКА
  if ($title == "") 
    return false;

  // SQL ЗАПИТ
  // якщо $title не пустий, то вставити (INSERT INTO) в таблицю articles такі значення: title, data, content (VALUES)- значення які передаються в тому ж порядку ("%s"...) - S означає, що тип даних строка
  $t = "INSERT INTO articles (title, date, content) VALUES ('%s', '%s', '%s')";

  // формуємо строку запиту
  $query = sprintf($t, mysqli_real_escape_string($link, $title), mysqli_real_escape_string($link, $date), mysqli_real_escape_string($link, $content));

  // виконуємо запит до бази даних
    $result = mysqli_query($link, $query);

    // якщо виникла помилка
    if (!$result)
      die(mysqli_error($link));

    // якщо дані успішно додалися, тоді 
    return true;
}

function articles_edit($link, $id, $title, $date, $content) {
   // ПІДГОТОВКА
  // прибираємо пробіли спочатку і вкінці trim(), якщо вони присутні
  $title = trim($title);
  $content = trim($content);
  $date = trim($date);
  // затверджуємо, що ID це число
  $id = (int)$id;

  // ПЕРЕВІРКА
  if ($title == "") 
    return false;

  // SQL ЗАПИТ
  // готуємо SQL запит, де UPDATE - обновити таблицю articles,
  // SET - встановити title (заголовок) = 1-му параметру, content = 2-му параметру, date = 3-му параметру, (WHERE) в тому запису, де id = 4-му параметру
  $sql = "UPDATE articles SET title='%s', content='%s', date='%s' WHERE id='%d'";
  
  // формуємо SQL запит
  $query = sprintf($sql, 
  // функція mysqli_real_escape_string проводить екранізацію вхідних параметрів, тобто додає зворотній слеш перед тими символами які можуть зіпсувати SQL запит  
  mysqli_real_escape_string($link, $title), // 1-й параметр
  mysqli_real_escape_string($link, $content), // 2-й параметр
  mysqli_real_escape_string($link, $date), // 3-й параметр
  $id); // 4-й параметр

  // виконаня SQL запит
  $result = mysqli_query($link, $query);

  // якщо не було ніяких результатів, потрібно призупинити роботу та вивести помилку
  if (!$result)
    die(mysqli_error($link));

  // якщо пройшло без помилок, то повертаємо кількість статтей, строк які було успішно відредаговано. В даному випадку значення функції приймає результат або 1 (якщо true), або 0 (якщо false)
  return mysqli_affected_rows($link);
  
}

// на вхід передаємо з"єднання з базою даних та ID
function articles_delete($link, $id) {
  // конвертуємо ID в ціле число
  $id = (int)$id;

  // ПЕРЕВІРКА
  // чи ID дорівнює "0", а воно = "0" тільки тоді, коли воно є не число або дійсно = "0"
  if ($id == 0) 
    return false;

  //SQL ЗАПИТ
  // формуємо  SQL запит
  // DELETE FROM - видалити з таблиці articles строку, (WHERE) в якій ID (id='%d') відповідає першому параметру
  // $id - є параметр якому має відповідати (дорівнювати)
  $query = sprintf("DELETE FROM articles WHERE id='%d'", $id);
  // виконуємо даний запит
  $result = mysqli_query($link, $query);

  // якщо помилка
  if (!$result)
    die(mysqli_error($link));

  // якщо немає ніякого результату, то повертаємо кількість строк до яких примінилась дана операція
  // в даному випадку так, як $id = унікальному значенню, то значення функції mysqli_affected_rows буде дорівнювати або "0", або "1"  
  return mysqli_affected_rows($link);
}

// функція для скорочення тексту поста
function articles_intro($text, $len = 500) {
// функція що повертає частину строки
// $text - копіює текст; "0" - починаючи з нульової позиції; $len - довжиною (яка задана в цьому параметрі)
return mb_substr($text, 0, $len);
}
?>