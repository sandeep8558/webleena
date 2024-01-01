<?php

namespace App\Controller;
use Core\Controller;
use Core\Element;

class ElementController extends Controller {

    function __construct() {
        Auth::auth();
    }

    public function create($request){
        $element = new Element();
        $r = $element->create($request['name'], $request['type'], $request['fields']);
        return json_encode($r);
    }

    public function update($request){
        return json_encode($request);
    }

    public function delete($request){
        $element = new Element();
        $r = $element->delete($request['name']);
        return json_encode($r);
    }

}