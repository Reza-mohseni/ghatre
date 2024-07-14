<?php

namespace App\Models\weather_conditions;

require_once '../../Models/ORM/BaseModel.php';
use App\Models\ORM\BaseModel;
class select extends BaseModel
{
    protected $table='weather_conditions';
    public function selects(){
        $selectweat=$this->all();
        return $selectweat;
    }

}