<?php

namespace App\Controller;
use Core\Controller;
use Core\Data;

class CrudController extends Controller {

    function __construct() {
        Auth::auth();
    }

    public function save($request){

        $data = new Data($request['file']);
        $typ = $data->propType($request['key']);
        $old_value = $data->prop($request['key']);

        if($typ == 'image' || $typ == 'file'){

            /* Uploading file */
            $request['val'] = $this->upload($request['val']);

            /* Delete file if exists */
            $this->deleteFile($old_value);

        }
        
        $data->save($request['key'], $request['val']);
        
        return json_encode($data->fetch());

    }

    public function fields($request){
        $data = new Data($request['file']);
        return json_encode($data->fields());
    }

    public function type($request){
        $data = new Data($request['file']);
        return json_encode($data->type());
    }

    public function rows($request){
        $data = new Data($request['file']);
        return json_encode($data->rows($request['key'], $request['val']));
    }

    public function all($request){
        $data = new Data($request['file']);
        return json_encode($data->all());
    }

    public function delete($request){
        $data = new Data($request['file']);
        $this->deleteFiles($request);
        $data->delete($request['id']);
        return json_encode($data->all());
    }

    public function insert($request){
        $data = new Data($request['file']);

        /* Upload Images here */
        $newRequest = $this->uploadFiles($request);

        $pureRequest = $this->purify($request['file'], $newRequest);
        $data->insert($pureRequest);

        $response = null;
        if($request['file'] == 'content'){
            $response = $data->rows('page_id', $request['page_id']);
        } else {
            $response = $data->all();
        }

        return json_encode($response);
    }

    public function update($request){
        $data = new Data($request['file']);
        $old_value = $data->get($request['id']);

        /* Upload Images here */
        $newRequest = $this->uploadFiles($request, $old_value);

        $pureRequest = $this->purify($request['file'], $newRequest);
        $data->update($request['id'], $pureRequest);
        return json_encode($data->all());
    }

    private function uploadFiles($request, $old = null){
        $data = new Data($request['file']);
        /* Getting all file or images keys in array */
        $keys = [];
        foreach($data->fields() as $field){
            if($field['type'] == 'image' || $field['type'] == 'file'){
                $keys[] = $field['name'];
            }
        }
        foreach($keys as $key){
            if(isset($request[$key])){
                /* File upload and update request with file path */
                $request[$key] = $this->upload($request[$key]);
                if($old != null){
                    $this->deleteFile($old[$key]);
                }
            }
        }
        /* Reeturns new request */
        return $request;
    }

    private function deleteFiles($request){
        $data = new Data($request['file']);
        $row = $data->get($request['id']);
        /* Getting all file or images keys in array */
        $keys = [];
        foreach($data->fields() as $field){
            if($field['type'] == 'image' || $field['type'] == 'file'){
                $keys[] = $field['name'];
            }
        }
        foreach($keys as $key){
            if(isset($row[$key])){
                $this->deleteFile($row[$key]);
            }
        }
    }

    private function upload($file){
        /* formed name for file */
        $name = time().'_'.mt_rand(100000,999999).'_'.$file['name'];
        /* file uploaded to server */
        move_uploaded_file($file['tmp_name'], "images/".$name);
        /* returning file path */
        return "/images/".$name;
    }

    private function deleteFile($path){
        /* Checked for path whether it is valid or not */
        if($path != null || $path != ""){
            /* Check for file if exists */
            if(file_exists(substr($path, 1))){
                /* Delete file */
                unlink(substr($path, 1));
            }
        }
    }

    private function purify($file, $request){
        $data = new Data($file);
        $fields = $data->fields();
        $pure = [];
        foreach($fields as $val){
            $key = $val['name'];
            if(isset($request[$key])){
                $v = $key == "password" ? base64_encode($request[$key]) : $request[$key];
                $pure[$key] = $v;
            }
        }
        return $pure;
    }

}