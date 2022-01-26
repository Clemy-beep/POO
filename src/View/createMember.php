<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Sign-up</title>
</head>

<body>
    <?php include './src/View/Templates/anonymous_header.html' ?>
    <h1>Sign Up</h1>
    <p>Which user type do you want to register ?</p>
    <select>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select> <br>
    <form method="POST" id="userform">
        <?php include './src/View/Templates/createUser.php'; ?>
    </form>
    <form method="POST" id="adminform">
        <?php include './src/View/Templates/createAdmin.php'; ?>
    </form>
</body>
<script>
    $('#adminform').css('display', 'none');
    $('#userform').css('display', 'none');

    $('select').on('change', function() {
        if ($('select').val() === 'user') {
            $('#userform').css('display', 'block');
            $('#adminform').css('display', 'none');
        } else {
            $('#adminform').css('display', 'block');
            $('#userform').css('display', 'none');
        }
    });
</script>

</html>