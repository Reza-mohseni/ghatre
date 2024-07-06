<?php
header('Content-Type: application/json');
require_once '../../Models/ORM/QueryBuilder.php';

use App\Models\ORM\QueryBuilder;

$queryBuilder = new QueryBuilder();
$results = $queryBuilder->select('DATE(created_at) as date, ROUND(AVG(degree_humidity) / 10.23, 0) as average_humidity')
    ->from('watering')
    ->whereLast30Days('created_at')
    ->groupBy('DATE(created_at)')
    ->execute();

$date=[];
$i=0;
foreach ($results as $item)
{
   $date['labels'][$i] = $item['date'];
    $date['data'][$i]=$item['average_humidity'];
    $i++;
}
echo json_encode($date);


 ?>