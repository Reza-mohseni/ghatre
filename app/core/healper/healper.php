<?php

//config
define('BASE_URL', 'https://danatm.ir');

function redirect($url)
{
    header('Location: '. trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
    exit;
}

function asset($file)
{
    return trim(BASE_URL, '/ ') . '/' .'app/views/assets/'. trim($file, '/ ');
}

function url($url)
{
    return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ');
}
// echo url('panel/category');

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    exit;
}
// $users = ['ali', 'hassan', 'karim'];
// dd($users);


