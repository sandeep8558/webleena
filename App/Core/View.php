<?php

namespace App\Core;

class View {

    function __construct() {
    }

    public static function render($view){
        $p = '../Resource/View/';
        include $p . $view . '.php';
    }

}