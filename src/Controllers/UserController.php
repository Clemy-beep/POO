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
        $userRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\User"));
        try {
            $users = $userRepository->findAll();
            return $users;
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            echo "Erro $code : $msg";
        }
    }
    public static function showUsers(array $users)
    {
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
            $_POST = array_map('trim', array_map('strip_tags', $_POST));
            $si = intval($_POST['serviceId']);
            $user = new User($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['age'],  $_POST['datas'], $si);
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
            throw new \Throwable('Missing datas. No user creation.');
        }
    }

    public static function updateUser($id)
    {
        $em = EntityManagerHelper::getEntityManager();
        $userRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\User"));
        $user = $userRepository->find($id);
        $user->setFirstName($_POST['firstname']);
        $user->setLastName($_POST['lastname']);
        $user->setServiceId($_POST['serviceId']);
        $user->setAge($_POST['age']);
        $user->setEmail($_POST['email']);
        $user->setPersonalDatas($_POST['datas'] ?? false);
        try {
            $em->flush();
            echo "User n°$id updated";
            echo '<a href="http://127.0.0.6/">Back to home</a>';
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $code = $e->getCode();
            echo "Error $code : $msg";
        }
    }
    public static function deleteUser($id)
    {
        $em = EntityManagerHelper::getEntityManager();
        $userRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\User"));
        $user = $userRepository->find($id);
        $em->remove($user);
        try {
            $em->flush();
        } catch (\Throwable $th) {
            $code = $th->getCode();
            $msg = $th->getMessage();
            echo "Erro $code : $msg";
        }
    }
}
