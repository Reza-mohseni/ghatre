<?php
namespace App\controllers\temperature;

require_once '../../Models/temperature/temperature.php';
use App\Models\temperature;

$temperatureC=$_POST['temperatureC'];
$temperatureF=$_POST['temperatureF'];
$dd=new temperature\temperature();
$dd->createtemperature($temperatureC,$temperatureF);

