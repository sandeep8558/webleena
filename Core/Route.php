<?php

namespace Core;
use Core\Request;
use Core\View;
use Core\Data;
use Core\Session;

class Route {

    private static array $handlers;

    function __construct() {
    }

    function __destruct() {
    }

    /* GET Method */
    public static function get(string $path, array $handler): void
    {
        self::addHandler('GET', $path, $handler);
    }

    /* POST Method */
    public static function post(string $path, array $handler): void
    {
        self::addHandler('POST', $path, $handler);
    }

    private static function addHandler(string $method, string $path, $handler): void
    {
        self::$handlers[] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public static function run()
    {

        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        self::createPages();

        $callback = null;
        foreach(self::$handlers as $handler){
            if($handler['path'] === $requestPath && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }
        
        if(!$callback){
            header(header: "HTTP/1.0 404 Not Found");
            return;
        }

        $request = [];
        switch($method){
            case "GET":
                $request = Request::get();
                break;
            case "POST":
                $request = Request::post();
                break;
        }

        if(sizeof($callback) >= 2){
            self::loader($callback, $request);
        }
    }

    private static function loader($callback, $request)
    {
        $model = new $callback[0];
        $method = $callback[1];
        echo $model->$method($request);
    }

    private static function createPages()
    {
        $pagesdata = new Data('pages');
        foreach($pagesdata->all() as $page){
            $path = $page['route'];
            $handler = [Route::class, 'handleDynamicPages'];
            self::addHandler('GET', $path, $handler);
        }
    }

    private static function handleDynamicPages($request)
    {
        View::render('app/index',['request' => $request]);
    }

}