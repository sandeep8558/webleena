<?php

namespace Core;
use Core\Data;

class Element {

    private $file;

    function __construct() {
        $this->file = 'elements';
    }

    public function create(string $name, string $type, string $fields){
        /* 
        1. Create PHP File
        2. Save data in data file
        */

        $fields_arr = json_decode($fields);

        $file = '../Elements/'.$name.'.data.php';

        if(file_exists($file)){
            $fo = fopen($file, "w");
            fclose($fo);
        }

        $str = "";
        foreach($fields_arr as $key=>$val){
            $str .= "\t\t[\n";
            foreach($val as $k=>$v){
                $str .= "\t\t\t'".$k."' => '". $v."',\n";
            }
            $str .= "\t\t],\n";
        }
        $str;

        file_put_contents(
            $file,
            "<?php \n\$element = [\n\t'name' => '".$name."',\n\t'type' => '".$type."',\n\t'fields' => [\n$str\t]\n];",
            LOCK_EX
        );

        $data = new Data('elements');
        $data->insert([
            'name' => $name,
            'type' => $type,
            'fields' => $fields,
        ]);

        return ["message" => "Element Created"];

    }

    public function update(int $id, string $name, string $type, string $fields){
        /* 
        1. Create PHP File
        2. Save data in data file
        */

        $fields_arr = json_decode($fields);

        $file = '../Elements/'.$name.'.data.php';

        if(file_exists($file)){
            $fo = fopen($file, "w");
            fclose($fo);
        }

        $str = "";
        foreach($fields_arr as $key=>$val){
            $str .= "\t\t[\n";
            foreach($val as $k=>$v){
                $str .= "\t\t\t'".$k."' => '". $v."',\n";
            }
            $str .= "\t\t],\n";
        }
        $str;

        file_put_contents(
            $file,
            "<?php \n\$element = [\n\t'name' => '".$name."',\n\t'type' => '".$type."',\n\t'fields' => [\n$str\t]\n];",
            LOCK_EX
        );

        $data = new Data('elements');
        $data->update($id, [
            'name' => $name,
            'type' => $type,
            'fields' => $fields,
        ]);

        return ["message" => "Element Updated"];

    }

    public function delete(string $name){

        $file = '../Elements/'.$name.'.data.php';
        $jsonfile = '../Elements/JSON/'.$name.'.data.php';

        if(file_exists($file)){
            unlink($file);
        }

        if(file_exists($jsonfile)){
            unlink($jsonfile);
        }

    }

}

