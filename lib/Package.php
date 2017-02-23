<?php

class Package {
    public $name;
    public $namespace;
    public $version;
    public $description;

    public $deps;

    public $repository;

    function getRepository() {
        return $this->repository;
    }

    function setRepository($repository) {
        $this->repository = $repository;
    }

    function getDescription() {
        return $this->description;
    }

    function getDeps() {
        return $this->deps;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDeps($deps) {
        $this->deps = $deps;
    }

    function getName() {
        return $this->name;
    }

    function getNamespace() {
        return $this->namespace;
    }

    function getVersion() {
        return $this->version;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setNamespace($namespace) {
        $this->namespace = $namespace;
    }

    function setVersion($version) {
        $this->version = $version;
    }
}