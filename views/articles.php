<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <title>My first blog</title>
  <link rel="stylesheet" href="../style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>My first blog</h1>
    <a href="admin">Admistrator panel</a>
    <div>

    <?php foreach($articles as $a) :?>

      <div class="article">
        <h3><a href="article.php?id=<?= $a['id']?>"><?= $a['title']?></a></h3>
        <em>Published: <?= $a['date']?></em>
        <!-- let's turn to the function that reduces the number of characters for outputting the text of the article -->
        <p><?= articles_intro($a['content']);?></p>
      </div>

      <?php endforeach ?>

    </div>
    <footer>
      <p>My first blog <br> Copyright &copy; <?php echo date("Y"); ?></p>
    </footer>
  </div>
</body>
</html>
