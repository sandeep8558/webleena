<?php

namespace App\Controller;
use Core\Controller;
use Core\Session;
use Core\View;
use Core\Data;
use Core\Mail;
use Core\Request;


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

    public function mail(){

        $req = Request::createFromGlobals();
        $request = $req->post;

        /* Check Email exist in records */
        $arr = [
            "email" => $request['email'],
        ];
        $data = new Data('auth');
        $is = $data->check($arr);

        if($is){
            
            /* Set OTP */
            $otp = mt_rand(100000,999999);
            $is = $data->updateAll("email", $request['email'], ["otp" => $otp]);
            
            /* Send Mail with OTP */
            $mail = new Mail();
            return $mail->send($request['email'], 'Webleena OTP', 'OTP is ' . $otp);

        } else {
            return json_encode(['error' => 'Email does not exists in our records.']);
        }
        
    }

    public function update_password(){
        
        $req = Request::createFromGlobals();
        $request = $req->post;

        $arr = [
            "email" => $request['email'],
            "otp" => $request['otp'],
        ];

        $data = new Data('auth');
        $is = $data->check($arr);

        if($is){
            $data->updateAll("email", $request['email'], ["password" => base64_encode($request['password'])]);
            return json_encode(['message' => 'Success']);
        } else {
            return json_encode(['error' => 'Wrong OTP Entered']);
        }

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