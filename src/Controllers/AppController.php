<?php

namespace App\Controllers;

class AppController
{
    public static function index()
    {
        include './src/View/homepage.php';
    }
    public static function showSignIn(){
        //include './src/View/createMember.php';
    }
    public static function showSignUp(){
        include './src/View/createMember.php';
    }
}
