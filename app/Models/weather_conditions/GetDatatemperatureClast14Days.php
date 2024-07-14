<?php

namespace App\Models\weather_conditions;
require_once '../../Models/ORM/QueryBuilder.php';
use App\Models\ORM\QueryBuilder;
class GetDatatemperatureClast14Days extends QueryBuilder
{
public function GetData(){
    $queryBuilder = new QueryBuilder();
    $results = $queryBuilder->select('DATE(created_at) as date,  ROUND(AVG(temperatureC))  as temperatureC')
        ->from('weather_conditions')
        ->whereLast14Days('created_at')
        ->groupBy('DATE(created_at)')
        ->orderBy('DATE(created_at)')
        ->execute();
    return $results;

}
}
