<?php

class DatabaseProject {
    public $name;
    public $description;
    public $versions = array();

    function addVersion($version) {
        $this->versions[] = $version;
    }

    function getVersions() {
        return $this->versions;
    }

    function setVersions($versions) {
        $this->versions = $versions;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setDescription($description) {
        $this->description = $description;
    }


}