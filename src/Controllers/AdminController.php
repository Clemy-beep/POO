<?php

namespace App\Controllers;

use App\Entity\Admin;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class AdminController
{
    public static function fetchAdmins(): array | false
    {
        $em = EntityManagerHelper::getEntityManager();
        $adminRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Admin"));
        try {
            $admins = $adminRepository->findAll();
            return $admins;
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            echo "Erro $code : $msg";
        }
        return false;
    }
    public static function showAdmins(array $admins)
    {
        include './src/View/showAdmins.php';
    }
    public static function showAdminForm()
    {
        include './src/View/createAdmin.php';
    }
    public static function createAdmin(): void
    {
        $em = EntityManagerHelper::getEntityManager();
        if (isset($_POST['serviceId'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['age'], $_POST['lvl'])) {
            $_POST = array_map('trim', array_map('strip_tags', $_POST));
            $si = intval($_POST['serviceId']);
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $admin = new Admin($si, $_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['email'], $_POST['lvl']);
                try {
                    $em->persist($admin);
                    $em->flush();
                    echo "New user" . $_POST['firstname'] . " created !";
                    echo '<a href="http://127.0.0.6/">Back to home</a>';
                } catch (Exception $e) {
                    $code = $e->getCode();
                    $msg = $e->getMessage();
                    echo "Erro $code : $msg";
                }
            } else throw new \Throwable('Email is not valid.');
        } else {
            throw new \Throwable('Missing datas, no admin creation.');
        }
    }
    public static function updateAdmin($id)
    {
        $em = EntityManagerHelper::getEntityManager();
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
    public static function deleteAdmin($id)
    {
        $em = EntityManagerHelper::getEntityManager();
        $adminRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Admin"));
        $admin = $adminRepository->find($id);
        $em->remove($admin);
        try {
            $em->flush();
        } catch (\Throwable $th) {
            $code = $th->getCode();
            $msg = $th->getMessage();
            echo "Erro $code : $msg";
        }
    }
}
