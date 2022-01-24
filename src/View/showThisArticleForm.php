<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit article n°<?= $id ?></title>
</head>

<body>
    <?php include './src/View/Templates/header.html';?>
    <h1>You are about to edit article n°<?= $id ?></h1>
    <form method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $article->getTitle() ?>" required><br>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10" required><?= $article->getContent()?></textarea>
        <input type="submit" value="Modify !">
    </form>
</body>

</html>