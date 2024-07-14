<?php

namespace App\Models\weather_conditions;

require_once '../../Models/ORM/QueryBuilder.php';
use App\Models\ORM\QueryBuilder;

class selectwherrain extends QueryBuilder
{
    public function selectraininwc()
    {
        $queryBuilder = new QueryBuilder();
        $results = $queryBuilder->select('rain.id, weather_conditions.humidity, weather_conditions.rain_id')
            ->from('weather_conditions')
            ->innerJoin('rain', 'weather_conditions.rain_id', 'rain.id')
            ->execute();
        echo '<pre>';
        return $results;





    }

}