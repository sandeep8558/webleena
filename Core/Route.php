<?php

namespace Core;
use App\Controller\PageController;

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

        $uri= strtok($_SERVER['REQUEST_URI'], "?");

        if($url == $uri){

            self::$isRoute = true;

            if(sizeof($arr) >= 2){
                $model_name = $arr[0];
                $model = new $model_name;
                $method = $arr[1];
                echo $model->$method();
            }

        }
    }

    public static function dynamic($page){

        $uri= strtok($_SERVER['REQUEST_URI'], "?");

        if($page['route'] == $uri){
            
            self::$isRoute = true;
            $model = new PageController();
            echo $model->index($page);

        }

    }

    public static function end(){
        if(!self::$isRoute){
            echo "Route not found";
            echo "<br>";
        }
    }

}