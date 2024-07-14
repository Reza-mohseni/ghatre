<?php

namespace App\Models\weather_conditions;

require_once '../../Models/ORM/BaseModel.php';
use App\Models\ORM\BaseModel;

class Update extends BaseModel
{
    protected $table = 'weather_conditions';

    public function updateweather($id, $data)
    {
        return $this->update($id, $data);

    }
}
