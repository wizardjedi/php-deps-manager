<?php

class PackageVersion {
    public $version;
    public $repo;
    public $deps;

    function getDeps() {
        return $this->deps;
    }

    function setDeps($deps) {
        $this->deps = $deps;
    }

    function getVersion() {
        return $this->version;
    }

    function getRepo() {
        return $this->repo;
    }

    function setVersion($version) {
        $this->version = $version;
    }

    function setRepo($repo) {
        $this->repo = $repo;
    }


}