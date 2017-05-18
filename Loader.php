<?php
namespace sugao2013\getui;
class Loader
{
    static function autoload($class)
    {
        echo 'autoload';
//        require_once  BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
         require  BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
//         require  BASEDIR.'\\'.$class.'.php';
//        echo __DIR__.'/'.str_replace('\\', '/', $class).'.php';
    }
}