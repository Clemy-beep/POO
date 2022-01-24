<?php

use App\Controllers\MemberController;
$members = MemberController::fetchMember();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post new article</title>
</head>

<body>
    <?php
    include './src/View/Templates/header.html' ?>
    <h1>Write new article</h1>
    <form method="POST">
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title"><br>
        <label for="content">Content</label><br>
        <textarea name="content" id="content" cols="30" rows="10"></textarea><br>
        <select name="authorId" id="authorId">
            <?php
            foreach ($members as $key => $member) {
                var_dump($member);
                $id = $member->getId();
                echo '<option value="' . $id . '">' . $id . '</option>';
            }
            ?>
        </select><br>
        <input type="submit" name="submit" value="Create">
    </form>
</body>

</html>