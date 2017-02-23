<?php

include(dirname(__FILE__).'/../lib/autoload.php');

class pd {
    public static function create() {
        return new self();
    }

    public function __construct() {

    }

    public function run() {
        $name = $_SERVER['argv'][1];

        echo "Using file: ".$name."\n";

        $data = file_get_contents($name);

        var_dump($data);

        $obj = json_decode($data, true);

        var_dump($obj);

        $package = PackageParser::parse($obj);

        var_dump($package);

        echo "-----\n";

        $package->getRepository()->checkout();
    }
}

pd::create()->run();
