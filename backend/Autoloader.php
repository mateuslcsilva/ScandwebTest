<?php
class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $path = $_SERVER['HTTP_HOST'] == 'localhost' ? './' : '/var/www/html/teste/scandiweb_test/';
            $file = str_replace('Project/', $path, str_replace('\\', '/', $class)).'.php';
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}

Autoloader::register();