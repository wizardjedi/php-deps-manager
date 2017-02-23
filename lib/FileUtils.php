<?php

class FileUtils {
    public static function createTempDirectory() {
        $tmp = rtrim(sys_get_temp_dir(),'\/');

        $path = null;
        do {
            $name = uniqid();

            $path = $tmp . DIRECTORY_SEPARATOR . $name;

            echo "Check path ${path}\n";
        } while (file_exists($path));

        mkdir($path);

        return $path;
    }
}

