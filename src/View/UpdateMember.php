<?php

use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

$em = EntityManagerHelper::getEntityManager();
$adminRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Admin"));
$userRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\User"));

$user = $userRepository->find($id);
$admin = $adminRepository->find($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a member</title>
</head>

<body>
    <?php include './src/View/Templates/header.html'; ?>

    <h1>You are updating member n°<?= $id ?></h1>
    <?php if ($memberClass === "Admin") : ?>
        <p>Your are updating an admin</p>
        <form method="post">
            <label for="serviceId">Service number</label><br>
            <input type="number" name="serviceId" id="serviceId" value="<?= $admin->getServiceId() ?>" required><br>
            <label for="firstname">Firstname</label><br>
            <input type="text" name="firstname" id="firstname" value="<?= $admin->getFirstName() ?>" required><br>
            <label for="lastname">Lastname</label><br>
            <input type="text" name="lastname" id="lastname" value="<?= $admin->getLastName() ?>" required><br>
            <label for="age">Age</label><br>
            <input type="number" name="age" id="age" value="<?= $admin->getAge() ?>" required><br>
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" value="<?= $admin->getEmail() ?>" required><br>
            <label for="lvl">Level</label><br>
            <input type="number" name="lvl" id="lvl" value="<?= $admin->getLevel() ?>" required><br>
            <input type="submit" value="Update !">
        </form>
    <?php else : ?>
        <p>You are updating a user</p>
        <form method="post">
            <label for="serviceId">Service number</label><br>
            <input type="number" name="serviceId" id="serviceId" value="<?= $user->getServiceId() ?>" required><br>
            <label for="firstname">Firstname</label><br>
            <input type="text" name="firstname" id="firstname" value="<?= $user->getFirstName() ?>" required><br>
            <label for="lastname">Lastname</label><br>
            <input type="text" name="lastname" id="lastname" value="<?= $user->getLastName() ?>" required><br>
            <label for="age">Age</label><br>
            <input type="number" name="age" id="age" value="<?= $user->getAge() ?>" required><br>
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" value="<?= $user->getEmail() ?>" required><br>
            <label for="datas">Do you agree on personnal datas collection ?</label><br>
            <input type="checkbox" name="datas" id="datas" ><br>
            <input type="submit" value="Update !">
        </form><br>
    <?php endif; ?>
</body>

</html>