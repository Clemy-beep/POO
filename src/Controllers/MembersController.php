<?php

namespace App\Controllers;

use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

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
}
