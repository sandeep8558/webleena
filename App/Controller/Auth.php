<?php

namespace App\Controller;
use App\Core\View;

class Auth {

    public function login(){
        View::render('auth/login');
    }

    public function forgot(){
        View::render('auth/forgot');
    }

    public function reset(){
        View::render('auth/reset');
    }

    public function authenticate(){
        return "Authenticate Page";
    }

}