<?php

class GitRepositoryParser {
    public static function parse($str) {
        $gitRepository = new GitRepository();

        list($proto, $gitUrl, $branchHash) = explode(':', $str);

        $gitRepository->setUrl($proto.':'.$gitUrl);

        if (strpos($branchHash, 'branch-') !== false) {
            $branch = substr($branchHash, 7);

            $gitRepository->setBranch($branch);
        } else {
            $gitRepository->setCommit($branchHash);
        }

        return $gitRepository;
    }
}
