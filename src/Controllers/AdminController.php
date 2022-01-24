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
            $si = intval($_POST['serviceId']);
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
        } else {
            var_dump($_POST);
            echo "Missing datas. No admin creation possible.";
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
