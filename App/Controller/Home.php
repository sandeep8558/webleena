<?php

namespace App\Controller;

use App\Core\View;

class Home {

    public function home(){
        $name = "Sandeep Vilas Rathod";
        View::render('app/demo', ['name' => $name]);
    }


}