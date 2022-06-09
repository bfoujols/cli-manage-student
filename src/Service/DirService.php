<?php

namespace ManageStudent\Service;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class DirService
{
    private $file;

    public function __construct()
    {
        $this->file = new Filesystem();
    }

    public function createDir(string $path) {
        try {
            if (!$this->file->exists($path)) {
                $this->file->mkdir($path);
                return true;
            }
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at ".$exception->getPath();
        }
    }

}