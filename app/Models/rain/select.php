<?php

namespace App\Models\rain;
require_once '../../Models/ORM/BaseModel.php';

use App\Models\ORM\BaseModel;
class select extends BaseModel
{
    protected $table = 'rain';

    public function selects()
    {
        return $this->all();
    }

}