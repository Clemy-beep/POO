<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Articles</title>
</head>

<body>
    <?php include './src/View/Templates/header.html';?>
   <h1>All articles</h1>
    <?php
    foreach ($articles as $key => $article) {
        $id = $article->getId();
        $titre = $article->getTitle();
        echo '
        <table>
            <title>All Articles</title>
            <tr>
                <th>Title</th>
                <th>Link</th>
            </tr>
            <tr>
                <td>'.$titre.'</td>
                <td><a href="http://127.0.0.6/article/'.$id.'">See Article</a></td>
            </tr>
        </table>
        ';
    }
    ?>
</body>

</html>