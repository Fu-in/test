<?php
require_once 'helpers/helper.php';
$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'dbname' => 'php_app',
        'username' => 'root',
        'password' => 'Parolamea',
    ],
];

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});