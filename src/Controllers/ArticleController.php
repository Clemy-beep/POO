<?php

namespace App\Controllers;

use App\Entity\Article;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;

class ArticleController
{

    public static function fetchArticles()
    {
        $em = EntityManagerHelper::getEntityManager();
        $articlesRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Article"));
        $articles = $articlesRepository->findAll();
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
    public static function modifyThisArticle($id): void
    {
        $em = EntityManagerHelper::getEntityManager();
        $articlesRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Article"));
        $article = $articlesRepository->find($id);
        $article->setTitle($_POST['title']);
        $article->setContent($_POST['content']);
        try {
            $em->flush();
            echo "Artcle n°$id successfully modified. ";
            echo '<a href="http://127.0.0.6/">Back to home</a>';
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            echo "Error $code : $msg";
        }
    }
    public static function deleteArticle($id)
    {
        $em = EntityManagerHelper::getEntityManager();
        $articlesRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Article"));
        $article = $articlesRepository->find($id);
        $em->remove($article);
        try {
            $em->flush();
            echo "Artcle n°$id successfully deleted. ";
            echo '<a href="http://127.0.0.6/">Back to home</a>';
        } catch (Exception $e) {
            $code = $e->getCode();
            $msg = $e->getMessage();
            echo "Error $code : $msg";
        }
    }
    public static function showArticleForm()
    {
        include './src/View/createArticle.php';
    }
    public static function createArticle()
    {
        $em = EntityManagerHelper::getEntityManager();
        if (isset($_POST['title'], $_POST['content'], $_POST['authorId'])) {
            $authorId = $_POST['authorId'];
            $authorRepository = new AbstractRepository($em, new ClassMetadata("App\Entity\Member"));
            $author = $authorRepository->find($authorId);
            $author->setFirstName($author->getFirstName());
            $author->setLastName($author->getLastName());
            $article = new Article($_POST['title'], $_POST['content'], $author);
            $em->persist($article);
            try {
                $em->flush();
                echo "Article saved successfully";
            } catch (\Exception $e) {
                $msg = $e->getMessage();
                $code = $e->getCode();
                echo "Error $code : $msg";
            }
        } else echo "Please fill all fields before submitting";
    }
}
