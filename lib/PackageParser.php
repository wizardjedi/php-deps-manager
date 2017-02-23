<?php

class PackageParser {

    public static function parse($data) {
        $p = new Package();

        list($namespace, $name) = explode('/', $data['name']);

        $p->setName($name);
        $p->setNamespace($namespace);

        $p->setDescription($data['description']);
        $p->setVersion($data['version']);

        $rep = $data['repository'];

        $gitUrl = $rep['git'];

        $p->setRepository(GitRepositoryParser::parse($gitUrl));

        return $p;
    }
}
