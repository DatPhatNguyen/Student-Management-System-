<?php
function my_autoLoader($className)
{
    // $folder = 'pages/';
    // $dot = '.php';
    // $fileName = $folder . $className . $dot;
    // if (!file_exists($fileName)) {
    //     return false;
    // }
    // include_once $folder . $className . $dot;
    include_once 'pages/' . $className . '.php';
}
spl_autoload_register('my_autoLoader');