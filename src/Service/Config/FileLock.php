<?php

namespace ManageStudent\Service\Config;

use ManageStudent\Entity\Repository;
use ManageStudent\Service\Date;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Filesystem\Filesystem;

class FileLock extends FileConfig
{
    private \DateTime $dateCreated;
    private \DateTime $dateUpdated;
    private array $listRepository = [];
    private array $listImport = [];

    /**
     * @return $this
     */
    public function createFileLock(): FileLock
    {
        $filesystem = new Filesystem();
        if (!$filesystem->exists($this->fileLock)) {
            $filesystem->touch($this->fileLock);
            $this->dateCreated = new \DateTime('now');
            $this->dateUpdated = new \DateTime('now');
        } else {
            // TODO load file exist
            $this->dateCreated = new \DateTime('now');
            // TODO del
            $this->dateUpdated = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @param string $nameRepository
     * @return $this
     */
    public function setRepository(string $nameRepository, bool $new = false): FileLock
    {
        $this->listRepository[] = ($new === true) ?
            (new Repository())->setDateCreated()->setId($nameRepository)->setName($nameRepository)
            : (new Repository())->setId($nameRepository)->setName($nameRepository);

        return $this;
    }

    private function encodeFileLock()
    {
        $arrFileLock["dateCreated"] = $this->dateCreated;
        $arrFileLock["dateUpdated"] = $this->dateUpdated;
        $arrFileLock["listRepository"] = $this->getListRepositoryToArray();
        $arrFileLock["listImport"] = [];

        return $arrFileLock;
    }

    private function getListRepositoryToArray()
    {
        $listRepository = [];

        foreach ($this->listRepository as $key => $item) {
            $listRepository[$key]["id"] = $item->getId();
            $listRepository[$key]["name"] = $item->getName();
            $listRepository[$key]["dateCreated"] = $item->getDateCreated();
        }

        return $listRepository;
    }

    public function putFileLock()
    {
        file_put_contents($this->fileLock, json_encode($this->encodeFileLock()));
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @return FileLock
     */
    public function setDateUpdated(): FileLock
    {
        $this->dateUpdated = new \DateTime('now');
        return $this;
    }

    /**
     * @return array
     */
    public function getListRepository(): array
    {
        return $this->listRepository;
    }

    /**
     * @param array $listRepository
     * @return FileLock
     */
    public function setListRepository(array $listRepository): FileLock
    {
        $this->listRepository = $listRepository;
        return $this;
    }

    /**
     * @return array
     */
    public function getListImport(): array
    {
        return $this->listImport;
    }
}