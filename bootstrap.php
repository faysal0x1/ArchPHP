<?php

use Core\App;
use Core\Container;

$container = new Core\Container();


$container->bind('Core\Database', function () {
    $config = require base_path('config.php');
    return new Core\Database(
        $config['database'],
        $config['database']['username'],
        $config['database']['password']
    );
});



App::setContainer($container);
