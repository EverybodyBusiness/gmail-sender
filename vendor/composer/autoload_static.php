<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit44311a3abeaffb716706b23183062c6a
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Elb\\GmailSender\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Elb\\GmailSender\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit44311a3abeaffb716706b23183062c6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit44311a3abeaffb716706b23183062c6a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit44311a3abeaffb716706b23183062c6a::$classMap;

        }, null, ClassLoader::class);
    }
}
