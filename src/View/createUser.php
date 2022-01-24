<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new Member</title>
</head>

<body>
    <?php include './src/View/Templates/header.html'; ?>

    <h1>Create a new User</h1>
    <form method="post">
        <label for="serviceId">Service number</label><br>
        <input type="number" name="serviceId" id="serviceId" required><br>
        <label for="firstname">Firstname</label><br>
        <input type="text" name="firstname" id="firstname" required><br>
        <label for="lastname">Lastname</label><br>
        <input type="text" name="lastname" id="lastname" required><br>
        <label for="age">Age</label><br>
        <input type="number" name="age" id="age" required><br>
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" required><br>
        <label for="datas">Do you agree on personnal datas collection ?</label><br>
        <input type="checkbox" name="datas" id="datas"><br>
        <input type="submit" value="Create !">
    </form><br>

    <a href="http://127.0.0.6/">Back to home</a>
</body>

</html>