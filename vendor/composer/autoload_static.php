<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6de73c3521f5e9c66fd847c113aa6b06
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fakerphp/faker/src/Faker',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6de73c3521f5e9c66fd847c113aa6b06::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6de73c3521f5e9c66fd847c113aa6b06::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit6de73c3521f5e9c66fd847c113aa6b06::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6de73c3521f5e9c66fd847c113aa6b06::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit6de73c3521f5e9c66fd847c113aa6b06::$classMap;

        }, null, ClassLoader::class);
    }
}
