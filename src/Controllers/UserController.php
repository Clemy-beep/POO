<?php

namespace App\Controllers;

use App\Entity\User;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class UserController
{
    public static function fetchUsers()
    {
        $em = EntityManagerHelper::getEntityManager();
        $userRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Admin"));
        try {
            $users = $userRepository->findAll();
            return $users;
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            echo "Erro $code : $msg";
        }
    }
    public static function showUsers (array $users){
        include './src/View/showUsers.php';
    }
    public static function showUserForm()
    {
        include './src/View/createUser.php';
    }
    public static function createUser()
    {
        $em = EntityManagerHelper::getEntityManager();
        if (isset($_POST['serviceId'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['age'], $_POST['datas'])) {
            $si = intval($_POST['serviceId']);
            $user = new User($_POST['firstname'], $_POST['lastname'],$_POST['email'], $_POST['age'],  $_POST['datas'],$si);
            try {
                $em->persist($user);
                $em->flush();
                echo "New user " . $_POST['firstname'] . " created !";
                echo '<a href="http://127.0.0.6/">Back to home</a>';
            } catch (Exception $e) {
                $code = $e->getCode();
                $msg = $e->getMessage();
                echo "Erro $code : $msg";
            }
        } else {
            var_dump($_POST);
            echo "Missing datas. No user creation possible.";
        }
    }
}
