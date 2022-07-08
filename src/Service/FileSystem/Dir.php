<?php

namespace ManageStudent\Service\FileSystem;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class Dir
 * Gestion du file directory
 *
 * @author Benoit Foujols
 */
class Dir
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
    public function createDir(string $path): bool
    {
        try {
            if (!$this->file->exists($path)) {
                $this->file->mkdir($path);
                return true;
            }
            return false;
        } catch (IOExceptionInterface $exception) {
            printf("%s (%s) \n", "Une erreur s'est produite lors de la création de votre répertoire", $exception->getMessage());
        }
    }

}