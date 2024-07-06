<?php

namespace App\Models\rain;

require_once '../../Models/ORM/BaseModel.php';
use App\Models\ORM\BaseModel;
class rain extends BaseModel
{
    protected $table='rain';
    public function insertrains($status){
        // تبدیل تاریخ‌ها به تایم‌استمپ
        $startDate = "2024-06-04 00:00:00";
        $endDate = "2024-7-4 23:59:59";
        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        // تولید یک عدد تصادفی بین تایم‌استمپ شروع و پایان
        $randomTimestamp = rand($startTimestamp, $endTimestamp);

        // تبدیل تایم‌استمپ تصادفی به یک تاریخ
        $randomDate = date("Y-m-d H:i:s", $randomTimestamp);



        $insertrain=[
            'status'=>$status,
            'created_at'=>$randomDate
        ];
        $this->save($insertrain);
    }

}