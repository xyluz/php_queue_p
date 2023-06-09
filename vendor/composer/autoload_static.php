<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6276b82ee9779c32a1e4ee32db8e0cf6
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '23c18046f52bef3eea034657bafda50f' => __DIR__ . '/..' . '/symfony/polyfill-php81/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'e39a8b23c42d4e1452234d762b03835a' => __DIR__ . '/..' . '/ramsey/uuid/src/functions.php',
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php81\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Filesystem\\' => 29,
            'Symfony\\Component\\Config\\' => 25,
        ),
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
            'Ramsey\\Collection\\' => 18,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Container\\' => 14,
        ),
        'I' => 
        array (
            'Interop\\Queue\\' => 14,
            'Interop\\Amqp\\' => 13,
        ),
        'E' => 
        array (
            'Enqueue\\SimpleClient\\' => 21,
            'Enqueue\\Null\\' => 13,
            'Enqueue\\Fs\\' => 11,
            'Enqueue\\Dsn\\' => 12,
            'Enqueue\\' => 8,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php81\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php81',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Symfony\\Component\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/config',
        ),
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Ramsey\\Collection\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/collection/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Interop\\Queue\\' => 
        array (
            0 => __DIR__ . '/..' . '/queue-interop/queue-interop/src',
        ),
        'Interop\\Amqp\\' => 
        array (
            0 => __DIR__ . '/..' . '/queue-interop/amqp-interop/src',
        ),
        'Enqueue\\SimpleClient\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/simple-client',
        ),
        'Enqueue\\Null\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/null',
        ),
        'Enqueue\\Fs\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/fs',
        ),
        'Enqueue\\Dsn\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/dsn',
        ),
        'Enqueue\\' => 
        array (
            0 => __DIR__ . '/..' . '/enqueue/enqueue',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Makasim' => 
            array (
                0 => __DIR__ . '/..' . '/makasim/temp-file/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'ReturnTypeWillChange' => __DIR__ . '/..' . '/symfony/polyfill-php81/Resources/stubs/ReturnTypeWillChange.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6276b82ee9779c32a1e4ee32db8e0cf6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6276b82ee9779c32a1e4ee32db8e0cf6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit6276b82ee9779c32a1e4ee32db8e0cf6::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit6276b82ee9779c32a1e4ee32db8e0cf6::$classMap;

        }, null, ClassLoader::class);
    }
}
