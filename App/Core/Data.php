<?php

namespace App\Core;

class Data {

    private $struct_file;
    private $json_file;
    private $stored_data;
    private $number_of_records;
    private $ids = [];

    function __construct($file_name) {
        
        /* Structure file path */
        $this->struct_file = "../Data/".$file_name.".data.php";
        
        /* JSON file path */
        $this->json_file = "../Data/JSON/".$file_name.".json";

        /* Create file if doesn't exists */
        $this->checkJSONFile();
        
        /* Data get from json file */
        $this->stored_data = json_decode(file_get_contents($this->json_file), true);

        if($this->type() == "recursive"){

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

    private function create_element(){}

    private function checkJSONFile(){
        if(!file_exists($this->json_file)){
            $file = fopen($this->json_file, "w");
            fclose($file);

            if($this->type() == "recursive"){
                $this->stored_data = [];
                $this->storeData();
            }

            if($this->type() == "static"){
                foreach($this->fields() as $key=>$val){
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

    /* Insert new record */
    public function insert(array $new_data){
        $data_with_id_field = $this->setUserId($new_data);
        array_push($this->stored_data, $data_with_id_field);
        $this->storeData();
    }

    /* Update Data */
    public function update(int $id, array $data){
        foreach($this->stored_data as $key => $row){
            if($row['id'] == $id) {
                foreach($data as $k=>$v){
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

    /* Get all fields */
    public function fields(){
        include $this->struct_file;
        return $element['fields'];
    }

    /* Get type of element */
    public function type(){
        include $this->struct_file;
        return $element['type'];
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

    public function get_row($key, $val){
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

    public function fetch(){
        return $this->stored_data;
    }

    /* get deta by key */
    public function get_value($key){
        $response = null;
        if(isset($this->stored_data[$key])){
            $response = $this->stored_data[$key];
        }
        return $response;
    }

    public function save($key, $val){
        $this->stored_data[$key] = $val;
        $this->storeData();
    }

}