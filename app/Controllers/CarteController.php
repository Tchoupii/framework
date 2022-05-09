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
        return view('test', ($data));
        

    }
    public function getCoordonnees(){
        $db = model(CitiesModel::class);
        $data = $db->query("SELECT GPS_LAT, GPS_LNG FROM CITIES WHERE name ="."'". $_GET['ville']."'"); 
        foreach($data->getResult() as $row){
           $tab['gps_lat'] = $row->GPS_LAT;
           $tab['gps_lng'] = $row->GPS_LNG;
        }

        return view('coordonnees',$tab);
    }
    public function getParcours(){
        $db = model(CitiesModel::class);
        try{
            $i = 0;
            $data = $db->query("SELECT get_distance_metres(".$_GET['gps_lat'].','.$_GET['gps_lng'].", GPS_LAT,GPS_LNG) AS proximite, SLUG, GPS_LAT, GPS_LNG FROM CITIES HAVING proximite < 20000 ;");
            foreach($data->getResult() as $row){
                $tab['GPS_LAT'][$i] = $row->GPS_LAT;
                $tab['GPS_LNG'][$i] = $row->GPS_LNG;
               $tab['nom'][$i] = $row->SLUG;
               $i = $i +1; 
        }
        return view('rayon', $tab);
    }catch(Exception $e){
            echo $e->getMessage();
        }
    }
        
    
}


?>