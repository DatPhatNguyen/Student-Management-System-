<?php
spl_autoload_register('autoLoad');
function autoLoad($className)
{
    $folder = 'pages/';
    $dot = '.php';
    $fileName = $folder . $className . $dot;
    if (!file_exists($fileName)) {
        return false;
    }
    include_once $folder . $className . $dot;
}