<?php

namespace App\Controller;
use Core\Controller;
use Core\Data;

class DisplayContentController extends Controller {

    function __construct() {
    }

    public function rows($request){
        $data = new Data($request['file']);
        return json_encode($data->rowsWithChildren($request['key'], $request['val']));
    }

    public function all($request){
        $data = new Data($request['file']);
        return json_encode($data->all());
    }

}