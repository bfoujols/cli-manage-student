<?php

namespace ManageStudent\Service\Config;

use DateTime;
use ManageStudent\Entity\Import;
use ManageStudent\Entity\Repository;
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
            $this->loadFileLock();
            $this->dateUpdated = new \DateTime('now');
        }

        return $this;
    }


    /**
     * @return void
     */
    private function loadFileLock(): void
    {
        $fileLock = json_decode(file_get_contents($this->fileLock), JSON_OBJECT_AS_ARRAY);
        // TODO TimeZone EUROPE
        $this->dateCreated = DateTime::createFromFormat($this->formatDateTime, $fileLock["dateCreated"]);
        $this->dateUpdated = DateTime::createFromFormat($this->formatDateTime, $fileLock["dateUpdated"]);

        foreach ($fileLock["listRepository"] as $key => $item) {
            $this->listRepository[$key] = (new Repository())->setId($item["id"])->setName($item["name"])->setDateCreated(DateTime::createFromFormat($this->formatDateTime, $item["dateCreated"]));
        }

        foreach ($fileLock["listImport"] as $key => $item) {
            $this->listImport[$key] = (new Import())->setId($item["id"])->setName($item["name"])->setDateCreated(DateTime::createFromFormat($this->formatDateTime, $item["dateCreated"]));
        }
    }

    /**
     * @param string $idStudent by NomanclatureService::getHashForId()
     * @param string $nameRepository
     * @return $this
     */
    public function setRepository(string $idStudent, string $nameRepository): FileLock
    {
        $this->listRepository[$idStudent] = (new Repository())->setDateCreated(new \DateTime('now'))->setId($nameRepository)->setName($nameRepository);

        return $this;
    }

    /**
     * @param string $nameImport
     * @return $this
     */
    public function setImport(string $nameImport): FileLock
    {
        // TODO Change le hash
        $id = hash("sha1", $nameImport . (new \DateTime('now'))->format($this->formatDateTime));
        $this->listImport[$id] = (new Import())->setId($id)->setName($nameImport)->setDateCreated(new \DateTime('now'));

        return $this;
    }

    /**
     * @return array
     */
    private function encodeFileLock(): array
    {
        $arrFileLock["dateCreated"] = $this->dateCreated->format($this->formatDateTime);
        $arrFileLock["dateUpdated"] = $this->dateUpdated->format($this->formatDateTime);
        $arrFileLock["listRepository"] = $this->getListRepositoryToArray();
        $arrFileLock["listImport"] = $this->getListImportToArray();

        return $arrFileLock;
    }

    private function getListImportToArray(): array
    {
        $listImport = [];

        foreach ($this->listImport as $item) {
            $key = hash("sha1", $item->getName() . $item->getDateCreated()->format($this->formatDateTime));
            $listImport[$key]["id"] = $item->getId();
            $listImport[$key]["name"] = $item->getName();
            $listImport[$key]["dateCreated"] = $item->getDateCreated()->format($this->formatDateTime);
        }

        return $listImport;
    }

    /**
     * @return array
     */
    private function getListRepositoryToArray(): array
    {
        $listRepository = [];

        foreach ($this->listRepository as $key => $item) {
            $listRepository[$key]["id"] = $item->getId();
            $listRepository[$key]["name"] = $item->getName();
            $listRepository[$key]["dateCreated"] = $item->getDateCreated()->format($this->formatDateTime);
        }

        return $listRepository;
    }

    public function putFileLock(): void
    {
        file_put_contents($this->fileLock, json_encode($this->encodeFileLock(), JSON_PRETTY_PRINT));
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