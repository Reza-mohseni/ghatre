<?php


namespace App\Models\weather_conditions;

use App\Models\ORM\BaseModel;

require_once '../../Models/ORM/BaseModel.php';
class weatherconditions extends BaseModel
{
    protected $table = 'weatherconditions';
    public function createtemperature($temperatureC,$temperatureF,$humidity){
        $weatherconditions=[
            'temperatureC' => $temperatureC,
            'temperatureF' => $temperatureF,
            'humidity' => $humidity,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->save($weatherconditions);
    }
}