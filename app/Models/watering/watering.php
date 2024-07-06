<?php

namespace App\Models\watering;
require_once '../../Models/ORM/BaseModel.php';
use App\Models\ORM\BaseModel;
class watering extends BaseModel
{
    protected $table='watering';

    public function insertwatering($watering_row,$status,$degree_humidity){
        $watering=[
            'watering_row'=>$watering_row,
            'status' => $status,
            'degree_humidity' => $degree_humidity,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->save($watering);
    }
}