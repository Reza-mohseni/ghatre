<?php

require_once '../vendor/autoload.php'; // مطمئن شوید این فایل وجود دارد و اتولودر Composer را بارگذاری می‌کند
require_once '../app/core/App.php';
use App\Core\Controller;
use App\Core\App;

require_once '../app/Models/ORM/check_DB.php';

$init=new App();