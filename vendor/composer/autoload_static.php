<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit639059abf270ed48ab5a846d28406dbc
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit639059abf270ed48ab5a846d28406dbc::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInit639059abf270ed48ab5a846d28406dbc::$classMap;

        }, null, ClassLoader::class);
    }
}
