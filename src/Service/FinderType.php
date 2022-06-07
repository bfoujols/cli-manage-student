<?php

namespace ManageStudent\Service;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FinderType
{
    const FILE_ACCEPT = ['*.xsl', '*.xlsx', '*.ods'];
    const HASH_TYPE = "crc32";
    const HASH_LENGHT = 8;

    private $pathCurrent;
    private $finder;
    private $listSplFileInfo = [];
    private $listFilename = [];
    private $selectSplFileInfo;


    public function __construct(string $path = "")
    {
        $this->pathCurrent = $path;
        $this->finder = new Finder();
    }

    /**
     * Retourne les fichiers demandes via le chemin
     *
     * @return array (Symfony\Component\Finder\SplFileInfo)
     */
    public function getFileListAccept()
    {
        $this->finder->files()->name(self::FILE_ACCEPT)->in($this->pathCurrent);
        if ($this->finder->hasResults()) {
            foreach ($this->finder as $file) {
                $id = hash(self::HASH_TYPE, $file->getRealPath());
                $this->listSplFileInfo[$id] = $file;
                $this->listFilename[$id] = $file->getFilename();
            }
        }
        return $this->listFilename;
    }

    /**
     * Retour l'objet SplFileInfo du fichier selectionne
     *
     * @param string $idSearch
     * @return SplFileInfo
     */
    public function setFileSelected(string $idSearch): SplFileInfo
    {
        if (array_key_exists($idSearch, $this->listSplFileInfo)) {
            $this->selectSplFileInfo = $this->listSplFileInfo[$idSearch];
            return $this->listSplFileInfo[$idSearch];
        }

        $idResult = array_search($idSearch, $this->listFilename, true);
        $this->selectSplFileInfo = $this->listSplFileInfo[$idResult];
        return $this->listSplFileInfo[$idResult];
    }

    /**
     * Retourne le path current
     *
     * @return false|string
     */
    public function getPathCurrent()
    {
        return getcwd();
    }

    public function isValidationPath()
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

    public function getListSplFileInfo(): array
    {
        return $this->listSplFileInfo;
    }

    public function getListUniqueFilename(): array
    {
        return $this->listFilename;
    }

    public function getListFilename(): array
    {
        return $this->listFilename;
    }


}