<?php
header('Content-Type: application/json');
require_once '../../Models/watering/GetDatalast14days.php';
require '../../../vendor/autoload.php';
use Morilog\Jalali\Jalalian;
use App\Models\watering\GetDatalast14days;

$results =new GetDatalast14days;
$results=$results->GetData();
$date=[];
$i=0;

foreach ($results as $item)
{
   $date['labels'][$i] = $jalaliDate = Jalalian::forge($item['date'])->format('Y/m/d');
    $date['data'][$i]=$item['average_humidity'];
    $i++;
}
echo json_encode($date);


 ?>