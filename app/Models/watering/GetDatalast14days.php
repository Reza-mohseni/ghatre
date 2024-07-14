<?php

namespace App\Models\watering;
require_once '../../Models/ORM/QueryBuilder.php';
use App\Models\ORM\QueryBuilder;
class GetDatalast14days extends QueryBuilder
{
public function GetData(){
    $queryBuilder = new QueryBuilder();
    $results = $queryBuilder->select('DATE(created_at) as date, ROUND(AVG(degree_humidity) / 10.23, 0) as average_humidity')
        ->from('watering')
        ->whereLast14Days('created_at')
        ->groupBy('DATE(created_at)')
        ->orderBy('DATE(created_at)')
        ->execute();
    return $results;

}
}