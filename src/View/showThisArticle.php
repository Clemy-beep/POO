<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article n°<?= $id ?></title>
</head>

<body>
    <?php include './src/View/Templates/header.html';?>
    <h1><?= $article->getTitle() ?></h1>
    <p><?= $article->getContent() ?></p>
    <p><?= $article->getAuthor()->getFirstName() . ' ' . $article->getAuthor()->getLastName() ?></p>
    <a href="http://127.0.0.6/article-modify/<?= $id ?>">Modify Article</a>
</body>

</html>