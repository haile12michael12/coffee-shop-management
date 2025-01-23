<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2a6e4f09c7d04e1045b9d4a6fe543eab
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Michael\\CoffeeShopManagement\\' => 29,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Michael\\CoffeeShopManagement\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2a6e4f09c7d04e1045b9d4a6fe543eab::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2a6e4f09c7d04e1045b9d4a6fe543eab::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2a6e4f09c7d04e1045b9d4a6fe543eab::$classMap;

        }, null, ClassLoader::class);
    }
}
