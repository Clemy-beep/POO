<?php

namespace App\Controllers;

use App\Entity\Admin;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class MemberController
{
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
        $em = EntityManagerHelper::getEntityManager();
        if ($memberClass === "User") {
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
        } else {
            $adminRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Admin"));
            $admin = $adminRepository->find($id);
            $admin->setFirstName($_POST['firstname']);
            $admin->setLastName($_POST['lastname']);
            $admin->setServiceId($_POST['serviceId']);
            $admin->setAge($_POST['age']);
            $admin->setEmail($_POST['email']);
            $admin->setLevel($_POST['lvl']);
            try {
                $em->flush();
                echo "$admin->getFirstName() updated";
                echo '<a href="http://127.0.0.6/">Back to home</a>';
            } catch (Exception $e) {
                $msg = $e->getMessage();
                $code = $e->getCode();
                echo "Error $code : $msg";
            }
        }
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
