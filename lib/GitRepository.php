<?php

class GitRepository extends Repository {
    public $url;
    public $branch = null;
    public $commit = null;

    function getUrl() {
        return $this->url;
    }

    function getBranch() {
        return $this->branch;
    }

    function getCommit() {
        return $this->commit;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setBranch($branch) {
        $this->branch = $branch;
    }

    function setCommit($commit) {
        $this->commit = $commit;
    }

    function checkout() {
        $tempName = FileUtils::createTempDirectory();

        echo "Directory ${tempName}\n";

        $pwd = getcwd();

        chdir($tempName);

        exec("git clone ".$this->getUrl().' .');

        if ($this->branch != null) {
            exec("git checkout ".$this->getBranch());
        } else {
            exec("git checkout ".$this->getCommit());
        }

        chdir($pwd);
    }

}
