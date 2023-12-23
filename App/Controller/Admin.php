<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\Session;
use App\Core\View;
use App\Core\Data;

use App\Controller\Auth;

class Admin extends Controller {

    function __construct() {
        Auth::auth();
    }

    public function dashboard(){
        View::render('admin/dashboard');
    }

    public function settings(){

        $data = new Data("settings");
        $settings = $data->fetch();
        $fields = $data->fields();

        View::render('admin/settings', ['settings' => $settings, 'fields' => $fields]);
    }

}