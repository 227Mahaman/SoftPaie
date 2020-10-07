<?php

use App\Database\db;
use Slim\Views\PhpRenderer;

$container = $app->getContainer();

$container['debug'] = function () {
    return true;
};

$container['db'] = function ($container) {
    return new db();
};

$container['view'] = function ($container){
    $dir = dirname(__DIR__);
    // Construisez la vue 
$phpView = new  PhpRenderer($dir . "/app/views/pages");
return $phpView;
};

// $container['session'] = function ($container) {
//     return new Session();
// };