<?php

require __DIR__ . '/vendor/autoload.php';
require "bootstrap.php";

use App\Controllers\AppController;
use App\Controllers\AdminController;
use App\Controllers\ArticleController;
use App\Controllers\MemberController;
use App\Controllers\UserController;
use App\Router\Router;

$router = new Router($_GET['url']);

//Home

$router->get('/', function () {
    AppController::index();
});

//MemberRoutes

$router->get('/members-all', function () {
    $members = MemberController::fetchMember();
    MemberController::showMember($members);
});
$router->get('/member-update/status=:memberClass-id=:id', function ($memberClass, $id) {
    MemberController::showUpdateMemberForm($memberClass, $id);
});
$router->post('/member-update/status=:memberClass-id=:id', function ($memberClass, $id) {
    MemberController::updateMember($memberClass, $id);
});
$router->get('/delete-member/status=:memberClass-id=:id', function ($memberClass, $id) {
    MemberController::deleteMember($memberClass, $id);
});

//Admin routes

$router->get('/create-member/admin', function () {
    AdminController::showAdminForm();
});
$router->post('/create-member/admin', function () {
    AdminController::createAdmin();
});
$router->get('admins-all', function () {
    $admins = AdminController::fetchAdmins();
    AdminController::showAdmins($admins);
});


//User routes

$router->get('/create-member/user', function () {
    UserController::showUserForm();
});
$router->post('/create-member/user', function () {
    UserController::createUser();
});
$router->get('/users-all', function () {
    $users = UserController::fetchUsers();
    UserController::showUsers($users);
});

//Articles routes
$router->get('/articles-all', function(){
    $articles = ArticleController::fetchArticles();
    ArticleController::showArticles($articles);
});
$router->get('/article/:id', function($id){
    ArticleController::showThisArticle($id);
});
$router->get('/article-modify/:id', function($id){
    ArticleController::showThisArticleForm($id);
});

$router->run();
