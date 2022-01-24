<?php

namespace App\Controllers;

use App\Entity\Article;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class ArticleController
{

    public static function fetchArticles()
    {
        $em = EntityManagerHelper::getEntityManager();
        $articlesRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Article"));
        $articles = $articlesRepository->findAll();
        var_dump($articles);
        return $articles;
    }
    public static function showArticles(array $articles): void
    {
        include "./src/View/showArticles.php";
    }
    public static function fetchThisArticle(int $id): Article
    {
        $em = EntityManagerHelper::getEntityManager();
        $articlesRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Article"));
        $article = $articlesRepository->find($id);
        return $article;
    }
    public static function showThisArticle(int $id): void
    {
        $article = ArticleController::fetchThisArticle($id);
        include './src/View/showThisArticle.php';
    }
    public static function showThisArticleForm($id): void
    {
        $article = ArticleController::fetchThisArticle($id);
        include './src/View/showThisArticleForm.php';
    }
}
