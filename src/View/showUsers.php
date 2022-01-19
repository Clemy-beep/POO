<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All members</title>
</head>
<style>
    header {
        text-align: center;
    }

    ul {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 1.5em;
    }
</style>

<body>
    <?php include './src/View/Templates/header.html'; ?>
    <h1>All Admins</h1>
    <table>
        <title>Members</title>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
        </tr>

        <?php
        //print("<pre>".print_r($members,true)."</pre>");

        foreach ($users as $key => $user) {
            $memberFirstName = $user->getFirstName();
            $memberLastName = $user->getLastName();
            $memberEmail = $user->getEmail();
            echo "
            <tr>
                <td>$memberFirstName</td>
                <td>$memberLastName</td>
                <td>$memberEmail</td>
            </tr>
            ";
        }
        ?>
    </table>
</body>

</html>