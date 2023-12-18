<?php

namespace App\Core;

class Route {

    public $path;
    public $request;
    public static $isRoute;

    function __construct() {
        $this->path = $_SERVER['REQUEST_URI'];
        $this->request = $_GET;
        self::$isRoute = false;
    }

    function __destruct() {
    }

    public function server(){
        foreach($_SERVER as $key=>$val){
            echo $key . ' - ' . $val;
            echo "<br>";
        }
    }

    public function request($key){
        return $this->request[$key];
    }

    public static function get($url, $arr){
        if($url == $_SERVER['REQUEST_URI']){
            echo $arr[0];
            echo "<br>";
            echo $url;
            echo "<br>";
            self::$isRoute = true;
        }
    }

    public static function end(){
        if(!self::$isRoute){
            echo "Route not found";
            echo "<br>";
        }
    }

}