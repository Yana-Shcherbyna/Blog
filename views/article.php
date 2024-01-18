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
    <div>
      <div class="article">
        <h3><?= $article['title']?></h3>
        <em>Published: <?= $article['date']?></em>
        <p><?= $article['content']?></p>
      </div>
    </div>
    <footer>
      <p>My first blog <br> Copyright &copy; 2023</p>
    </footer>
  </div>
</body>
</html>
