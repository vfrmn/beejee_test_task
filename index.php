<?php

session_start();

require_once 'Core/Helper.php';
require_once 'Core/config.php';
spl_autoload_register(function ($class_name) {
    $filePath = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name . '.php');
    if (file_exists($filePath)) require_once $filePath;
});


$router = new Core\Router();
$router->run();

