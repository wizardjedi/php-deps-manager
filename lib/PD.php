<?php

class PD {
    protected $pwd;

    protected $pdFilePath;

    protected $pdFileName = 'pd.json';

    /**
     *
     * @var Database
     */
    protected $db;

    function getPwd() {
        return $this->pwd;
    }

    function getPdFilePath() {
        return $this->pdFilePath;
    }

    function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    function setPdFilePath($pdFilePath) {
        $this->pdFilePath = $pdFilePath;
    }


    public static function create() {
        return new self();
    }

    public function usage() {
        echo "php pd.php command\n";
        echo "\n";

        echo "\tupdate - Read pd.json in current directory and update deps\n";
        echo "\tupdate [path to pd.json]\n";
        echo "\n";
    }

    public function update($arguments) {
        if (isset($arguments[2])) {
            $this->setPdFilePath($arguments[2]);
        }

        $filePath = $this->findPdFile();

        echo "Use file: ".$this->getPdFilePath();

        $data = $this->parseFile($this->getPdFilePath());

        var_dump($data);
    }

    public function findPdFile() {
        if ($this->getPdFilePath() == null) {
            $this->setPdFilePath(getcwd());
        }

        if (substr($this->getPdFilePath(), '-'.strlen($this->pdFileName)) === $this->pdFileName) {
            if (!file_exists($this->getPdFilePath())) {
                throw new Exception('Deps file not found');
            }
        } else {
            $fileFound = false;
            $tmpDir = rtrim($this->getPdFilePath(),'\\/');
            $filePath = null;
            do {
                $filePath = $tmpDir . DIRECTORY_SEPARATOR . $this->pdFileName;

                $fileFound = file_exists($filePath);

                $tmpDir = rtrim(realpath($tmpDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR),'\\/');

            } while (!$fileFound && $tmpDir !== '');

            if ($fileFound) {
                $this->setPdFilePath($filePath);
            } else {
                throw new Exception('Deps file not found');
            }
        }

        return $this->getPdFilePath();
    }

    public function parseFile($path) {
        $content = file_get_contents($path);

        echo $content;

        $data = json_decode($content, true);

        return $data;
    }

    public function apiGetPackage($name, $version = null) {
        $this->loadDataBaseFromFile();

        $package = new Package();

        $dataBaseProject = $this->db->getProjects()[$name];

        list($namespace, $name) = explode('/', $dataBaseProject->getName());

        $package->setName($name);
        $package->setNamespace($namespace);
        $package->setDescription($dataBaseProject->getDescription());

        $versions = $dataBaseProject->getVersions();

        if ($version === null) {
            $packageVersion = $versions[count($versions)-1];
        } else {
            foreach ($versions as $ver) {
                if ($ver->getVersion() == $version) {
                    $packageVersion = $ver;
                }
            }
        }

        $package->setVersion($packageVersion->getVersion());
        $package->setRepository($packageVersion->getRepo());

        $package->setDeps($packageVersion->getDeps());

        die(json_encode($package));
    }

    public function apiListPackages() {
        $this->loadDataBaseFromFile();

        $projects = $this->db->getProjects();

        $result = array();

        foreach ($projects as $prj) {
            $result[] = $prj->getName();
        }

        die(json_encode($result));
    }

    public function loadDataBaseFromFile() {
        $str = file_get_contents('../data/database.json');

        $data = json_decode($str, true);

        $dataArray = $data['projects'];

        $this->db = new Database();

        foreach ($dataArray as $projectArray) {
            $project = new DatabaseProject();

            $project->setName($projectArray['name']);
            $project->setDescription($projectArray['description']);

            $versions = $projectArray['versions'];

            foreach ($versions as $versionArray) {
                $version = new PackageVersion();

                $version->setVersion($versionArray['version']);

                $gitRepo = new GitRepository();

                $gitRepo->setUrl($versionArray['repo']['url']);
                $gitRepo->setUrl($versionArray['repo']['branch']);
                $gitRepo->setUrl($versionArray['repo']['commit']);

                $version->setRepo($gitRepo);

                $version->setDeps($versionArray['deps']);

                $project->addVersion($version);
            }

            $this->db->addProject($project);
        }
    }
}
