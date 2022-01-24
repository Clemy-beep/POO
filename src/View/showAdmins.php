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
        <a href="http://127.0.0.6/delete-member/status=" . $memberClass . "id=" . id">Delete</a>
        <?php
        //print("<pre>".print_r($members,true)."</pre>");

        foreach ($admins as $key => $admin) {
            $memberFirstName = $admin->getFirstName();
            $memberLastName = $admin->getLastName();
            $memberEmail = $admin->getEmail();
            $memberId = $admin->getId();
            $memberClass = (get_class($admin) === "App\Entity\User") ? "User" : "Admin";
            echo '
            <tr>
                <td>' . $memberFirstName . '</td>
                <td>' . $memberLastName . '</td>
                <td>' . $memberEmail . '</td>
                <td><a href="http://127.0.0.6/member-update/status=' . $memberClass . '-id=' . $memberId . '">Edit</a></td>
                <td><a href="http://127.0.0.6/delete-member/status=' . $memberClass . '-' . 'id=' . $memberId . '">Delete</a></td>
            </tr>
            ';
        }
        ?>
    </table>

</body>

</html>