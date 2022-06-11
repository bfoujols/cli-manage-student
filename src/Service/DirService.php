<?php

namespace ManageStudent\Service;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class DirService
 * Gestion du file directory
 *
 * @author Benoit Foujols
 */
class DirService
{
    private $file;

    public function __construct()
    {
        $this->file = new Filesystem();
    }

    /**
     * Creation d'un repertoire si celui-ci n'est pas deja present
     *
     * @param string $path
     * @return bool|void
     */
    public function createDir(string $path) {
        try {
            if (!$this->file->exists($path)) {
                $this->file->mkdir($path);
                return true;
            }
        } catch (IOExceptionInterface $exception) {
            echo "Une erreur s'est produite lors de la création de votre répertoire";
        }
    }

}