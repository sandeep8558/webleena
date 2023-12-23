<?php

use App\Core\Session;

function layout($view){
    $p = '../Resource/View/';
    include $p . $view . '.php';
}

function section($section){
    echo "I am Section " . $section;
}

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function redirect($url) {
    header('Location: '.$url);
    die();
}

function session(){
    return $data = Session::getInstance();
}

function input($field, $name, $val){
    //return $field;
    $input = "";
    switch($field){

        case "text":
        $input = "<input class='p-4 d-block w-100' type='text' name='{$name}' id='{$name}' value='{$val}' />";
        break;

        case "textarea":
        $input = "<textarea class='p-4 d-block w-100' rows='7' type='text' name='{$name}' id='{$name}' value='{$val}'></textarea>";
        break;

        case "color":
        $input = "<input class='p-4 d-block w-100' type='text' name='{$name}' id='{$name}' value='{$val}' />";
        break;

        case "switch":
        $input = "<input class='p-4 d-block w-100' type='text' name='{$name}' id='{$name}' value='{$val}' />";
        break;

        case "password":
        $input = "<input class='p-4 d-block w-100' type='password' name='{$name}' id='{$name}' value='{$val}' />";
        break;

        case "email":
        $input = "<input class='p-4 d-block w-100' type='email' name='{$name}' id='{$name}' value='{$val}' />";
        break;

        case "file":
        $input = "<input class='p-4 d-block w-100' type='file' name='{$name}' id='{$name}' />";
        break;

    }
    return $input;
}