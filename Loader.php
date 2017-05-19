<?php
namespace sugao2013\getui;
/**
 用法
define('BASEDIR', __DIR__);
include BASEDIR.'/IMooc/Loader.php';
spl_autoload_register('\\IMooc\\Loader::autoload');
 */
class Loader
{
    static function autoload($class)
    {
         require  BASEDIR.'/'.str_replace('\\', '/', $class).'.php';
    }
}