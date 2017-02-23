<?php

include(dirname(__FILE__).'/../lib/autoload.php');

$pd = PD::create();

$arguments = $_SERVER['argv'];

if (sizeof($arguments) == 1 || $arguments[1] == '--help') {
    $pd->usage();
} else {
    $command = strtolower($arguments[1]);

    switch ($command) {
        case 'update':
            $pd->update($arguments);
            break;
        default:
            throw new Exception("Unknown command '${command}'");
    }
}

