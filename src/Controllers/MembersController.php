<?php

namespace App\Controllers;

use App\Entity\Admin;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class MemberController
{
    public static function createMember()
    {
        if (isset($_POST)) {
            $_POST = array_map('trim', array_map('strip_tags', $_POST));
            var_dump($_POST);
            if (isset($_POST['lvl'])) {
                AdminController::createAdmin();
            } else if (isset($_POST['datas'])) {
                UserController::createUser();
            };
        } else throw new \Throwable('No data provided.');
    }
    public static function fetchMember()
    {
        $em = EntityManagerHelper::getEntityManager();
        $membersRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Member"));
        $query = $membersRepository->findAll();

        return $query;
    }

    public static function showMember($members)
    {
        include './src/View/showMembers.php';
    }
    public static function showUpdateMemberForm($memberClass, $id)
    {
        include './src/View/UpdateMember.php';
    }
    public static function updateMember($memberClass, $id)
    {
        if (isset($_POST)) {
            $_POST = array_map('trim', array_map('strip_tags', $_POST));
            if ($memberClass === "User") {
                UserController::updateUser($id);
            } else {
                AdminController::updateAdmin($id);
            }
        } else throw new \Throwable('No data found.');
    }
    public static function deleteMember($memberClass, $id)
    {
        if ($memberClass === "Admin") {
            try {
                AdminController::deleteAdmin($id);
                echo "Admin n°$id successfully deleted !";
                echo '<a href="http://127.0.0.6/">Back to home</a>';
            } catch (Exception $e) {
                $msg = $e->getMessage();
                $code = $e->getCode();
                echo "Error $code : $msg";
            }
        } else {
            try {
                UserController::deleteUser($id);
                echo "User n°$id successfully deleted !";
                echo '<a href="http://127.0.0.6/">Back to home</a>';
            } catch (Exception $e) {
                $msg = $e->getMessage();
                $code = $e->getCode();
                echo "Error $code : $msg";
            }
        }
    }
}
