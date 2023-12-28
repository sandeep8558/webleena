<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\View;

class PageController extends Controller {

    public function index($page){
        //echo json_encode($page);
        View::render('app/demo', ['page' => $page]);
    }

}