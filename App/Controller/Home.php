<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\Data;
use App\Core\View;

class Home extends Controller {

    public function home(){
        $name = "Sandeep Vilas Rathod";
        View::render('app/demo', ['name' => $name]);
    }

}