<?php
require_once '../../Models/rain/select.php';
use App\Models\rain\select;
require '../../../vendor/autoload.php';
use Morilog\Jalali\Jalalian;

$result = new select();
$result = $result->selects();
$data = [];
$i = 0;
$state = 0;
$days_of_week_farsi = [
    'Sunday' => 'یکشنبه',
    'Monday' => 'دوشنبه',
    'Tuesday' => 'سه‌شنبه',
    'Wednesday' => 'چهارشنبه',
    'Thursday' => 'پنج‌شنبه',
    'Friday' => 'جمعه',
    'Saturday' => 'شنبه'
];

foreach ($result as $item) {
    if ($state == 0 && $item['status'] == '1') {
        $datetime = new DateTime($item['created_at']);
        $day_of_week_english = $datetime->format('l');
        $day_of_week_farsi = $days_of_week_farsi[$day_of_week_english];
        $data['weekday'][$i] = $day_of_week_farsi;
        $data['time'][$i] = $datetime->format('H:i:s');
        $jalaliDate = Jalalian::forge($item['created_at'])->format('Y/m/d');
        $data['date'][$i] = $jalaliDate;
        $state = 1;
        $data['status'][$i] = 'پایان باران';
        $i++;
    } elseif ($state == 1 && $item['status'] == '0') {
        $datetime = new DateTime($item['created_at']);
        $day_of_week_english = $datetime->format('l');
        $day_of_week_farsi = $days_of_week_farsi[$day_of_week_english];
        $data['weekday'][$i] = $day_of_week_farsi;
        $data['time'][$i] = $datetime->format('H:i:s');
        $jalaliDate = Jalalian::forge($item['created_at'])->format('Y/m/d');
        $data['date'][$i] = $jalaliDate;
        $data['status'][$i] = 'شروع باران';
        $state = 0;
        $i++;
    } else {
        continue;
    }
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 0;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = ($page) * $limit;

if ($page>=0) {
    $weekday = array_slice($data['weekday'], $offset, $limit);
    $time = array_slice($data['time'], $offset, $limit);
    $status = array_slice($data['status'], $offset, $limit);
    $date = array_slice($data['date'], $offset, $limit);

    $data['data'] = [];
    for ($i = 0; $i < count($weekday); $i++) {
        $data['data'][] = [
            'weekday' => $weekday[$i],
            'time' => $time[$i],
            'status' => $status[$i],
            'date' => $date[$i],
        ];
    }
}

header('Content-Type: application/json');
echo json_encode([
    'data' => $data['data'],
    'totalItems' => count($data['status'])
]);