<?php

function my_autoloader($class) {
    $dirname = dirname(__FILE__);

    try {
        include $dirname.'/' . $class . '.php';
    } catch (Exception $e) {
        var_dump($e);
    }
}

spl_autoload_register('my_autoloader');
