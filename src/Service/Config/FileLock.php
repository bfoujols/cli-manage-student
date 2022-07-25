<?php

namespace ManageStudent\Service\Config;

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
        $this->dateCreated = new \DateTime($fileLock["dateCreated"]["date"]);
        $this->dateUpdated = new \DateTime($fileLock["dateUpdated"]["date"]);

        foreach ($fileLock["listRepository"] as $key => $item) {
            $this->listRepository[$key] = (new Repository())->setId($item["id"])->setName($item["name"])->setDateCreated(new \DateTime($item["dateCreated"]["date"]));
        }

        // TODO Debug Mode
        //var_dump($fileLock);
        //exit();
    }

    /**
     * @param string $nameRepository
     * @return $this
     */
    public function setRepository(string $idStudent, string $nameRepository, bool $new = false): FileLock
    {
        $this->listRepository[$idStudent] = ($new === true) ?
            (new Repository())->setDateCreated(new \DateTime('now'))->setId($nameRepository)->setName($nameRepository)
            : (new Repository())->setId($nameRepository)->setName($nameRepository);

        return $this;
    }

    /**
     * @return array
     */
    private function encodeFileLock(): array
    {
        $arrFileLock["dateCreated"] = $this->dateCreated;
        $arrFileLock["dateUpdated"] = $this->dateUpdated;
        $arrFileLock["listRepository"] = $this->getListRepositoryToArray();
        $arrFileLock["listImport"] = [];

        return $arrFileLock;
    }

    /**
     * @return array
     */
    private function getListRepositoryToArray()
    {
        $listRepository = [];

        // TODO Debug Mode
        var_dump($this->listRepository);
        exit();

        foreach ($this->listRepository as $key => $item) {
            $listRepository[$key]["idStudent"] = $key;
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