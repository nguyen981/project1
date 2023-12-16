<?php
/**
 * autoload.php
 *
 * Autoloader for Tecnick.com libraries
 *

 *
 * This file is part of tc-lib-pdf software library.
 */
spl_autoload_register(
    function ($class) {
        $prefix = 'Com\\Tecnick\\';
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }
        $relative_class = substr($class, $len);
        $file = dirname(__DIR__).'/'.str_replace('\\', '/', $relative_class).'.php';
        if (file_exists($file)) {
            require $file;
        }
    }
);
