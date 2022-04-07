<?php

namespace App\Controllers;

class CarteController extends BaseController
{
    public function index(){
        return view('carte');
    }
    public function getVilles(){
        $db = model(CitiesModel::class);
        $data['query'] = $db->findAll();
        if($data){
            echo("OK");
        }
        return view('test', $data);
        

    }

}

?>