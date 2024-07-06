<?php

require_once '../../Models/rain/rain.php';

use App\Models\rain\rain;

$status=$_POST['status'];

$insert= new rain();
$insert->insertrains($status);