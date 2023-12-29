<?php

use Core\Session;
use Core\Data;

$session = Session::getInstance();
$settings = new Data('settings');
$settings = $settings->fetch();

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

function parseInterpolation($data){
    $dt = gettype($data);
    if($dt == 'string') {
        echo $data;
    } else {
        echo json_encode($data);
    }
}