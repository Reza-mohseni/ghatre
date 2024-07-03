<?php


namespace App\Models\temperature;

use App\Models\ORM\BaseModel;

require_once '../../Models/ORM/BaseModel.php';
class temperature extends BaseModel
{
    protected $table = 'temperature';
    public function createtemperature($temperatureC,$temperatureF){
        $temperatureC=[
            'temperatureC' => $temperatureC,
            'temperatureF' => $temperatureF,
            'created_at' => date('Y-m-d H:i:s')
        ];
        return $this->save($temperatureC);
    }
}