<?php

namespace App\Controller;

use Core\Request;
use Core\Controller;
use Core\Data;

class CrudController extends Controller {

    function __construct() {
        Auth::auth();
    }

    public function save(){

        $req = Request::createFromGlobals();
        $request = $req->post;

        $data = new Data($request['file']);
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

    public function fields(){
        $req = Request::createFromGlobals();
        $request = $req->get;
        $data = new Data($request['file']);
        return json_encode($data->fields());
    }

    public function all(){
        $req = Request::createFromGlobals();
        $request = $req->get;
        $data = new Data($request['file']);
        return json_encode($data->all());
    }

    public function delete(){
        $req = Request::createFromGlobals();
        $request = $req->post;
        $data = new Data($request['file']);
        $data->delete($request['id']);
        return json_encode($data->all());
    }

    public function insert(){
        $req = Request::createFromGlobals();
        $request = $req->post;
        $data = new Data($request['file']);
        $pureRequest = $this->purify($request['file'], $request);
        $data->insert($pureRequest);
        return json_encode($data->all());
    }

    public function update(){
        $req = Request::createFromGlobals();
        $request = $req->post;
        $data = new Data($request['file']);
        $pureRequest = $this->purify($request['file'], $request);
        $data->update($request['id'], $pureRequest);
        return json_encode($data->all());
    }

    public function purify($file, $request){
        $data = new Data($file);
        $fields = $data->fields();
        $pure = [];
        foreach($fields as $key=>$val){
            if(isset($request[$key])){
                $v = $key == "password" ? base64_encode($request[$key]) : $request[$key];
                $pure[$key] = $v;
            }
        }
        return $pure;
    }

}