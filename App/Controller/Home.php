<?php

namespace App\Controller;

use App\Core\View;

class Home {

    public function home(){
        View::render('app/demo');
    }


}