<?php

namespace App\Models\rain;

require_once '../../Models/ORM/BaseModel.php';
require_once '../../Models/weather_conditions/select.php';
require_once '../../Models/weather_conditions/Update.php';
use App\Models\ORM\BaseModel;
use App\Models\weather_conditions\Update;

class rain extends BaseModel
{
    protected $table='rain';
    public function insertrains($status){
        $insertrain=[
            'status'=>$status,
            'created_at'=>date("Y-m-d H:i:s")
        ];
        $this->save($insertrain);
        $selectrain=$this->all();
        $selectrain=end($selectrain);
        $selectweath=new \App\Models\weather_conditions\select;
        $selectweath=$selectweath->selects();
       $selectweath=end($selectweath);
        $updateweath=new Update();
        $data=[
            'rain_id'=>$selectrain['id'],
        ];
        $updateweath->updateweather($selectweath['id'],$data);


    }

}