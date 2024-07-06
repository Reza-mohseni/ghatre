<?php
require_once '../../Models/watering/watering.php';

use App\Models\watering\watering;
$watering_row=$_POST['watering_row'];
$status=$_POST['status'];
$degree_humidity=$_POST['degree_humidity'];
$insert= new watering;
$insert->insertwatering($watering_row,$status,$degree_humidity);