<?php
// spl_autoload_register('autoLoad');
// function autoLoad($className)
// {
//     $folder = 'pages/';
//     $dot = '.class.php';
//     $fileName = $folder . $className . $dot;
//     if (!file_exists($fileName)) {
//         return false;
//     }
//     include_once $fileName;
// }
spl_autoload_register(function ($className) {
    $folderName = './pages/';
    require_once($folderName . $className . 'php');
});