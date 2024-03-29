<?php

namespace App\Controller;

use Core\Controller;
use Core\Session;
use Core\View;
use Core\Data;
use Core\Element;

use App\Controller\Auth;

class Admin extends Controller {

    function __construct() {
        Auth::auth();
    }

    public function dashboard(){
        View::render('admin/dashboard');
    }

    public function settings(){
        View::render('admin/settings');
    }

    public function user(){
        View::render('admin/user');
    }

    public function pages(){
        View::render('admin/pages');
    }

    public function navigation(){
        $data = new Data("pages");
        $pages = json_encode($data->all());
        View::render('admin/navigation', ['pages' => $pages]);
    }

    public function layout(){
        View::render('admin/layout');
    }

    public function elements(){
        View::render('admin/elements');
    }

    public function element_crud($request){
        View::render('admin/element', ['request' => $request]);
    }

}