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
    <h1>All members</h1>
    <table>
        <title>Members</title>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Status</th>
        </tr>

        <?php
        //print("<pre>".print_r($members,true)."</pre>");

        foreach ($members as $key => $member) {
            $memberFirstName = $member->getFirstName();
            $memberLastName = $member->getLastName();
            $memberId = $member->getId();
            $memberClass = (get_class($member) === "App\Entity\User") ? "User" : "Admin";
            echo '
            <tr>
                <td>' . $memberFirstName . '</td>
                <td>' . $memberLastName . '</td>
                <td>' . $memberClass . '</td>
                <td><a href="http://127.0.0.6/member-update/status=' . $memberClass . '-id=' . $memberId . '">Edit</a></td>
                <td><a href="http://127.0.0.6/delete-member/status=' . $memberClass . '-' . 'id=' . $memberId . '">Delete</a></td>
            </tr>
            ';
        }
        ?>
    </table>
</body>


</html>