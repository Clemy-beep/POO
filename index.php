<?php

require __DIR__ . '/vendor/autoload.php';
require "bootstrap.php";

use App\Controllers\AppController;
use App\Controllers\AdminController;
use App\Controllers\MemberController;
use App\Controllers\UserController;
use App\Router\Router;

$router = new Router($_GET['url']);

//Home

$router->get('/', function () {
    AppController::index();
});

//MemberRoutes

$router->get('/all-members', function () {
    $members = MemberController::fetchMember();
    MemberController::showMember($members);
});

//Admin routes

$router->get('/create-member/admin', function () {
    AdminController::showAdminForm();
});
$router->post('/create-member/admin', function () {
    AdminController::createAdmin();
});
$router->get('/all-admins', function () {
    $admins = AdminController::fetchAdmins();
    AdminController::showAdmins($admins);
});
$router->get('/admin-update/:id', function($id){
    echo "You are updating admin n°$id";
});

//User routes

$router->get('/create-member/user', function () {
    UserController::showUserForm();
});
$router->post('/create-member/user', function () {
    UserController::createUser();
});
$router->get('/all-users', function () {
    $users = UserController::fetchUsers();
    UserController::showUsers($users);
});

//Articles routes

$router->run();
