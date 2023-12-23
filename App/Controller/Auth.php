<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\Session;

use App\Core\View;
use App\Core\Data;


class Auth extends Controller {

    const LOGIN = "/login";
    const DASHBOARD = "/dashboard";

    function __construct() {
    }

    public function login(){
        $this->guest();
        View::render('auth/login');
    }

    public function forgot(){
        $this->guest();
        View::render('auth/forgot');
    }

    public function authenticate(){
        
        if(isset($_POST['email'], $_POST['password'])){
            
            $arr = [
                "email" => $_POST['email'],
                "password" => base64_encode($_POST['password'])
            ];
            
            $data = new Data('auth');
            $is = $data->check($arr);
            
            if($is){
                $session = Session::getInstance();
                $session->email = $_POST['email'];
                redirect(self::DASHBOARD);
            }
        }
        redirect(self::LOGIN);
    }

    public function logout(){
        $session = Session::getInstance();
        $session->destroy();
        redirect(self::LOGIN);
    }

    public static function auth(){
        $session = Session::getInstance();
        $is = $session->__isset("email");
        if(!$is){
            redirect(self::LOGIN);
        }
    }

    public static function guest(){
        $session = Session::getInstance();
        $is = $session->__isset("email");
        if($is){
            redirect(self::DASHBOARD);
        }
    }

}