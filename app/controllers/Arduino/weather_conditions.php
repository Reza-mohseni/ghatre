<?php

require_once '../../Models/weather_conditions/weather_conditions.php';
use App\Models\weather_conditions;

$temperatureC=$_POST['temperatureC'];
$temperatureF=$_POST['temperatureF'];
$humidity=$_POST['humidity'];
$insert=new weather_conditions\weatherconditions();

$insert->createtemperature($temperatureC,$temperatureF,$humidity);

