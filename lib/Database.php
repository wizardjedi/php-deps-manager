<?php

class Database {
    public $projects = array();

    function getProjects() {
        return $this->projects;
    }

    function setProjects($projects) {
        $this->projects = $projects;
    }

    function addProject($project) {
        $this->projects[$project->getName()] = $project;
    }
}
