<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInitba483f2a60f9573f2e99b22e1e7bf418
=======
class ComposerAutoloaderInit28faf94e25b9f157baf8283b08628237
>>>>>>> development
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInitba483f2a60f9573f2e99b22e1e7bf418', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInitba483f2a60f9573f2e99b22e1e7bf418', 'loadClassLoader'));
=======
        spl_autoload_register(array('ComposerAutoloaderInit28faf94e25b9f157baf8283b08628237', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        spl_autoload_unregister(array('ComposerAutoloaderInit28faf94e25b9f157baf8283b08628237', 'loadClassLoader'));
>>>>>>> development

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
<<<<<<< HEAD
            composerRequireba483f2a60f9573f2e99b22e1e7bf418($file);
=======
            composerRequire28faf94e25b9f157baf8283b08628237($file);
>>>>>>> development
        }

        return $loader;
    }
}

<<<<<<< HEAD
function composerRequireba483f2a60f9573f2e99b22e1e7bf418($file)
=======
function composerRequire28faf94e25b9f157baf8283b08628237($file)
>>>>>>> development
{
    require $file;
}
