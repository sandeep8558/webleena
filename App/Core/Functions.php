<?php

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