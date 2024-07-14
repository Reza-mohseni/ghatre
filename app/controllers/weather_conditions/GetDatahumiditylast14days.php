<?php
header('Content-Type: application/json');
require_once '../../Models/weather_conditions/GetDatahumiditylast14days.php';
require '../../../vendor/autoload.php';
use Morilog\Jalali\Jalalian;
use App\Models\weather_conditions\GetDatahumiditylast14Days;

$results =new GetDatahumiditylast14Days;
$results=$results->GetData();
$date=[];
$i=0;

foreach ($results as $item)
{
   $date['labels'][$i] = $jalaliDate = Jalalian::forge($item['date'])->format('Y/m/d');
    $date['data'][$i]=$item['humidity'];
    $i++;
}
echo json_encode($date);


 ?>