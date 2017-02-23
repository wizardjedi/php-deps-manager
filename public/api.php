<?php

include('../lib/autoload.php');

$command = strtolower($_GET['command']);

$pd = new PD();

switch ($command) {
    case 'list':
        $pd->apiListPackages();
    case 'get':
        $pd->apiGetPackage($_GET['name'],$_GET['version']);
}