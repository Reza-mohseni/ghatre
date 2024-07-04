<?php

namespace App\Models\rain;

require_once '../ORM/BaseModel.php';
use App\Models\ORM\BaseModel;
class rain extends BaseModel
{
    protected $table='rain';
    public function insertrain($status){
        $insertrain=[
            'status'=>$status,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        $this->save($insertrain);
    }

}