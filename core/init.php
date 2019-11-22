<?php
session_start();
require_once 'helpers/helper.php';
$GLOBALS['config'] = [
    'mysql' => [
        'host' => '127.0.0.1',
        'dbname' => 'php_app',
        'username' => 'root',
        'password' => 'Parolamea',
    ],
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800,
    ],
    'session' => [
        'session_name' => 'user',
        'token_name' => 'token',
    ],
];

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});