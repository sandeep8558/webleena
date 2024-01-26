<?php

namespace App\Controller;
use Core\Controller;
use Core\Data;

class DisplayContentController extends Controller {

    public $dir;

    function __construct() {
        $this->dir="../Data";
    }

    public function rows($request){
        $dir = (isset($request['dir'])) ? $request['dir'] : $this->dir;
        $data = new Data($request['file'], $dir);
        return json_encode($data->rowsWithChildren($request['key'], $request['val']));
    }

    public function all($request){
        $dir = (isset($request['dir'])) ? $request['dir'] : $this->dir;
        $data = new Data($request['file'], $dir);
        return json_encode($data->all());
    }

}