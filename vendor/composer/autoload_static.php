<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa8da935bc8894ca7d4aeca2f8be04e9
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'sugao2013\\getui\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'sugao2013\\getui\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa8da935bc8894ca7d4aeca2f8be04e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa8da935bc8894ca7d4aeca2f8be04e9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}