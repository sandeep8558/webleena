<?php

namespace Core;

class Data {

    private $struct_file;
    private $json_file;
    private $stored_data;
    private $number_of_records;
    private $ids = [];

    function __construct($file_name, $path="../Data") {
        
        /* Structure file path */
        $this->struct_file = $path."/".$file_name.".data.php";
        
        /* JSON file path */
        $this->json_file = $path."/JSON/".$this->name().".json";

        /* Create file if doesn't exists */
        $this->checkJSONFile();
        
        /* Data get from json file */
        $this->stored_data = json_decode(file_get_contents($this->json_file), true);

        if(($this->type() == "recursive" || $this->type() == "element") && $this->stored_data != null){

            /* Cound number of records */
            $this->number_of_records = count($this->stored_data);

            /* Creating array of ids */
            if($this->number_of_records != 0){
                foreach ($this->stored_data as $data) {
                    array_push($this->ids, $data['id']);
                }
            }

        }
    }

    /* Check for file exists or not, and creates the file when does not exists */
    private function checkJSONFile(){
        if(!file_exists($this->json_file)){
            
            $file = fopen($this->json_file, "w");
            fclose($file);

            if($this->type() == "element"){
                $this->stored_data = [];
                $this->storeData();
            }

            if($this->type() == "recursive"){
                $this->stored_data = [];
                $this->storeData();
            }

            if($this->type() == "static"){
                foreach($this->fields() as $val){
                    $key = $val['name'];
                    $this->stored_data[$key] = "";
                }
                $this->storeData();
            }

        }
    }

    /* Set Id incrementally */
    private function setId(array $row){
        if($this->number_of_records == 0){
            $row['id'] = 1;
        }else{
            $row['id'] = max($this->ids) + 1;
        }
        return $row;
    }

    /* Store data to file */
    private function storeData(){
        file_put_contents(
            $this->json_file,
            json_encode($this->stored_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX
        );
    }

    public function dropJSON(){
        if(file_exists($this->json_file)){
            unlink($this->json_file);
        }
    }







    /* Get all fields */
    public function fields(){
        include $this->struct_file;
        return $element['fields'];
    }

    /* Get name of element */
    public function name(){
        include $this->struct_file;
        return $element['name'];
    }

    /* Get type of element */
    public function type(){
        include $this->struct_file;
        return $element['type'];
    }

    /* Get length of array of element */
    public function length(){
        include $this->struct_file;
        return count($element['fields']);
    }

    /* Check property exists or not */
    public function isProp($prop){
        $is = false;
        foreach($this->fields() as $field){
            if($field['name'] == $prop){
                $is = true;
            }
        }
        return $is;
    }

    public function propType($key){
        $type = null;
        foreach($this->fields() as $field){
            if($field['name'] == $key){
                $type = $field['type'];
            }
        }
        return $type;
    }







    /* Fetch Static Data */
    public function fetch(){
        return $this->stored_data;
    }

    /* get deta by key */
    public function prop($key){
        $response = null;
        if($this->type() == 'static'){
            if($this->isProp($key) && isset($this->stored_data[$key])){
                $response = $this->stored_data[$key];
            }
        }
        return $response;
    }

    /* Save Static Data */
    public function save($key, $val){
        if($this->type() == 'static'){
            if($this->isProp($key)){
                $this->stored_data[$key] = $val;
                $this->storeData();
            }
        }
    }







    /* Insert new record */
    public function insert(array $new_data){
        $pureData = $this->purify($new_data);
        $data_with_id_field = $this->setId($pureData);
        array_push($this->stored_data, $data_with_id_field);
        $this->storeData();
        return $data_with_id_field;
    }

    /* Update Data */
    public function update(int $id, array $data){
        $pureData = $this->purifyOnly($data);
        foreach($this->stored_data as $key => $row){
            if($row['id'] == $id) {
                foreach($pureData as $k=>$v){
                    $this->stored_data[$key][$k] = $v;
                }
            }
        }
        $this->storeData();
    }

    /* Update by kye-value pair */
    public function updateAll($mykey, $myval, array $data){
        $pureData = $this->purifyOnly($data);
        foreach($this->stored_data as $key => $row){
            if($row[$mykey] == $myval) {
                foreach($pureData as $k=>$v){
                    $this->stored_data[$key][$k] = $v;
                }
            }
        }
        $this->storeData();
    }

    /* Delete Data */
    public function delete(int $id){
        foreach($this->stored_data as $key => $row){
            if($row['id'] == $id){
                unset($this->stored_data[$key]);
            }
        }
        $this->storeData();
    }

    /* Delete All Data */
    public function deleteAll(){
        foreach($this->stored_data as $key => $row){
            unset($this->stored_data[$key]);
        }
        $this->storeData();
    }

    public function purify(array $data){
        $pureData = [];
        foreach($this->fields() as $f){
            $key = $f['name'];
            $pureData[$key] = isset($data[$key]) ? $data[$key] : "";
        }
        return $pureData;
    }

    public function purifyOnly(array $data){
        $pureData = [];
        foreach($this->fields() as $f){
            $key = $f['name'];
            if(isset($data[$key])){
                $pureData[$key] = $data[$key];
            }
        }
        return $pureData;
    }








    /* Check Values exists or not */
    public function check($arr){
        $response = false;
        $is = [];
        foreach($arr as $key=>$val){
            $is[] = in_array($val, array_column($this->stored_data, $key));
        }
        $response = !in_array(false, $is);
        return $response;
    }

    /* get all data */
    public function all(){
        return $this->stored_data;
    }

    /* Get data by id */
    public function get($id){
        $response = null;
        if(in_array($id, array_column($this->stored_data, "id"))){
            foreach($this->stored_data as $row){
                if($row['id'] == $id){
                    $response = $row;
                }
            }
        }
        return $response;
    }

    /* get row by key value */
    public function row($key, $val){
        $response = null;
        if(in_array($val, array_column($this->stored_data, $key))){
            foreach($this->stored_data as $row){
                if($row[$key] == $val){
                    $response = $row;
                }
            }
        }
        return $response;
    }

    /* get rows by key value */
    public function rows($key, $val){
        $response = [];
        if(in_array($val, array_column($this->stored_data, $key))){
            foreach($this->stored_data as $row){
                if($row[$key] == $val){
                    $response[] = $row;
                }
            }
        }
        return $response;
    }

    public function rowsWithChildren($key, $val){
        $response = [];
        if(in_array($val, array_column($this->stored_data, $key))){
            foreach($this->stored_data as $row){
                if($row[$key] == $val){
                    $row['children'] = $this->rowsWithChildren('parent', $row['id']);
                    $response[] = $row;
                }
            }
        }
        return $response;
    }

}