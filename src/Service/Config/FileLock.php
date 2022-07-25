<?php

namespace ManageStudent\Service\Config;

use DateTime;
use ManageStudent\Entity\Repository;
use ManageStudent\Entity\Student;
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
    }

    /**
     * @param string $nameRepository
     * @return $this
     */
    public function setRepository(string $idStudent, string $nameRepository, bool $new = false): FileLock
    {
        if ($new === true) {
            $this->listRepository[$idStudent] = (new Repository())->setDateCreated(new \DateTime('now'))->setId($nameRepository)->setName($nameRepository);
        }

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
        $arrFileLock["listImport"] = [];

        return $arrFileLock;
    }

    /**
     * @return array
     */
    private function getListRepositoryToArray(): array
    {
        $listRepository = [];

        // TODO Debug Mode
        //var_dump($this->listRepository);
        //exit();

        foreach ($this->listRepository as $key => $item) {
            $listRepository[$key]["idStudent"] = $key;
            $listRepository[$key]["id"] = $item->getId();
            $listRepository[$key]["name"] = $item->getName();
            $listRepository[$key]["dateCreated"] = $item->getDateCreated()->format($this->formatDateTime);
        }

        return $listRepository;
    }

    public function putFileLock(): void
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