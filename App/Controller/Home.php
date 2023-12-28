<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\Data;
use App\Core\View;

class Home extends Controller {

    public function home(){

        $data = new Data('example');
        $d = [
            'mobile' => '9000000009'
        ];
        $data->update(6, $d);

        // echo json_encode($data->fields());
        // echo "<br>";
        // echo $data->type();
        // echo "<br>";
        // echo $data->name();
        // echo "<br>";
        // echo $data->length();
        // echo "<br>";
        // echo $data->fetch()['mobile'];
        // echo "<br>";
        // echo json_encode($data->fetch());

        // View::render('app/demo');
    }

}