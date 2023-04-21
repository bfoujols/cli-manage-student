<?php

namespace Studoo\Service\FileSystem;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FinderType
 * Gestion et liste des fichiers acceptes dans le path demande
 *
 * @author Benoit Foujols
 */
class FinderType
{
    private const HASH_TYPE = "crc32";

    private string $pathCurrent;
    private Finder $finder;
    private array $listSplFileInfo = [];
    private array $listFilename = [];


    public function __construct(string $path = "")
    {
        $this->pathCurrent = $path;
        $this->finder = new Finder();
    }

    /**
     * Retourne les fichiers demandes via le chemin cible
     *
     * @return array (Symfony\Component\Finder\SplFileInfo)
     */
    public function getFileListAccept(): array
    {
        $this->finder->files()->name(FileExtension::getListExtensionByName())->in($this->pathCurrent);
        if ($this->finder->hasResults()) {
            foreach ($this->finder as $file) {
                $idHash = hash(self::HASH_TYPE, $file->getRealPath());
                $this->listSplFileInfo[$idHash] = $file;
                $this->listFilename[$idHash] = $file->getFilename();
            }
        }
        return $this->listFilename;
    }

    /**
     * Retour l'objet SplFileInfo du fichier selectionne
     *
     * @param string $idSearch
     *
     * @return SplFileInfo
     */
    public function setFileSelected(string $idSearch): SplFileInfo
    {
        if (array_key_exists($idSearch, $this->listSplFileInfo)) {
            return $this->listSplFileInfo[$idSearch];
        }

        $idResult = array_search($idSearch, $this->listFilename, true);
        return $this->listSplFileInfo[$idResult];
    }

    /**
     * Retourne le path courant
     *
     * @return false|string
     */
    public function getPathCurrent()
    {
        return getcwd();
    }

    /**
     * Validation du path courant
     *
     * @return bool
     */
    public function isValidationPath(): bool
    {
        $this->finder->files()->in($this->pathCurrent);
        return $this->finder->hasResults();
    }

    /**
     * Set le chemin à traiter
     *
     * @param string $path
     *
     * @Fluent
     * @return FinderType $this
     */
    public function setPath(string $path): FinderType
    {
        $this->pathCurrent = $path;
        return $this;
    }

    /**
     * Renvoi le chemin à traiter
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->pathCurrent;
    }

    /**
     * Renvoi un tableau d'objet <SplFileInfo>
     *
     * @return array
     */
    public function getListSplFileInfo(): array
    {
        return $this->listSplFileInfo;
    }

    /**
     * Renvoi un tableau des filenames
     *
     * @return array
     */
    public function getListFilename(): array
    {
        return $this->listFilename;
    }


}
