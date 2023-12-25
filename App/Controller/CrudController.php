<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Controller;
use App\Core\Data;

class CrudController extends Controller {

    function __construct() {
        Auth::auth();
    }

    public function save(){

        $req = Request::createFromGlobals();
        $request = $req->post;

        $data = new Data("settings");
        $old_value = $data->get_value($request['key']);

        if(count($req->files) > 0){
            $file = $req->files['val'];

            $name = time().'_'.mt_rand(100000,999999).'_'.$file['name'];
            move_uploaded_file($file['tmp_name'], "images/".$name);
            $request['val'] = "/images/".$name;

            if($old_value != null || $old_value != ""){
                if(file_exists(substr($old_value, 1))){
                    unlink(substr($old_value, 1));
                }
            }
        }

        $data->save($request['key'], $request['val']);
        return json_encode($data->fetch());
    }

}