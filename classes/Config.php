<?php

class Config
{
    public static function get($path)
    {
        $config = $GLOBALS['config'];
        $path = explode('/', $path);

        if ($path) {
            foreach ($path as $bit) {
                $config = $config[$bit];
            }
        }
        return $config;
    }
}
