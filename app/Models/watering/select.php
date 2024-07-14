<?php

namespace App\Models\watering;

require_once '../../Models/ORM/BaseModel.php';
require_once '../../Models/ORM/QueryBuilder.php';
use App\Models\ORM\BaseModel;
use App\Models\ORM\QueryBuilder;
class select extends BaseModel {
    protected $table = 'watering';


    public function selects() {
        $selectweat=$this->all();
        return $selectweat;
    }

    public function selectsendrow1() {
        $query = new QueryBuilder();

        $row1 = $query->select('*')
            ->from('watering')
            ->where('watering_row', '=', '1')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->execute();
        return $row1;
    }
    public function selectsendrow2() {
        $query = new QueryBuilder();

        $row1 = $query->select('*')
            ->from('watering')
            ->where('watering_row', '=', '2')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->execute();
        return $row1;
    }
    public function selectsendrow3() {
        $query = new QueryBuilder();

        $row1 = $query->select('*')
            ->from('watering')
            ->where('watering_row', '=', '3')
            ->orderBy('id', 'DESC')
            ->limit(1)
            ->execute();
        return $row1;
    }

}
