<?php
/*
 * Ce fichier fait partie du projet Studoo.
 *
 * (c) Benoit Foujols <Benoit.Foujols@ac-creteil.fr>
 *
 * Pour les informations complètes sur les droits d'auteur et la licence,
 * veuillez consulter le fichier LICENSE qui a été distribué avec ce code source.
 */

namespace Studoo\Service\Config;

use DateTime;
use Studoo\Entity\Import;
use Studoo\Entity\Repository;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Gestion du fichier lock après la génération d'une commande d'écriture
 * Ce fichier se nomme studoo.lock et se positionne sur le path d'exécution
 */
class FileLock extends FileConfig
{
    private \DateTime $dateCreated;
    private \DateTime $dateUpdated;
    private array $listRepository = [];
    private array $listImport = [];

    /**
     * Creation et chargement du fichier lock
     *
     * @return $this
     */
    public function createFileLock(): FileLock
    {
        $filesystem = new Filesystem();

        if (!$filesystem->exists($this->fileLock)) {
            $filesystem->touch($this->fileLock);
            $this->dateCreated = new \DateTime('now');
            $this->dateUpdated = new \DateTime('now');
            return $this;
        }

        $this->loadFileLock();
        $this->dateUpdated = new \DateTime('now');
        return $this;
    }


    /**
     * Chargement du fichier lock
     *
     * @return void
     */
    private function loadFileLock(): void
    {
        $fileLock = json_decode(file_get_contents($this->fileLock), JSON_OBJECT_AS_ARRAY);
        // TODO TimeZone EUROPE
        $this->dateCreated = DateTime::createFromFormat($this->formatDateTime, $fileLock["dateCreated"]);
        $this->dateUpdated = DateTime::createFromFormat($this->formatDateTime, $fileLock["dateUpdated"]);

        foreach ($fileLock["listRepository"] as $key => $item) {
            $this->listRepository[$key] = (new Repository())
                ->setId($item["id"])
                ->setName($item["name"])
                ->setDateCreated(DateTime::createFromFormat($this->formatDateTime, $item["dateCreated"]));
        }

        foreach ($fileLock["listImport"] as $key => $item) {
            $this->listImport[$key] = (new Import())
                ->setId($item["id"])
                ->setName($item["name"])
                ->setDateCreated(DateTime::createFromFormat($this->formatDateTime, $item["dateCreated"]));
        }
    }

    /**
     * Ajout du repertoire racine de l'étudiant
     *
     * @param string $idStudent by NomanclatureService::getHashForId()
     * @param string $nameRepository
     * @return $this
     */
    public function setRepository(string $idStudent, string $nameRepository): FileLock
    {
        $this->listRepository[$idStudent] = (new Repository())
            ->setDateCreated(new \DateTime('now'))
            ->setId(
                $nameRepository
            )->setName($nameRepository);

        return $this;
    }

    /**
     * Ajout de la liste des repertoire racine des étudiants
     *
     * @param array $listRepository
     * @return FileLock
     */
    public function setListRepository(array $listRepository): FileLock
    {
        $this->listRepository = $listRepository;
        return $this;
    }

    /**
     * Récuperation des répertoires des étudiants par key
     * La key est généré par NomanclatureService::getHashForId()
     *
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

    /**
     *  Récuperation des répertoires des étudiants (raw)
     *
     * @return array
     */
    public function getListRepository(): array
    {
        return $this->listRepository;
    }

    /**
     * Ajout du fichier d'import
     *
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
     * Renvoi la liste des fichiers d'import
     * @return array
     */
    public function getListImport(): array
    {
        return $this->listImport;
    }

    /**
     * @return array
     */
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
     * Struture du fichier lock
     *
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

    /**
     * Ecriture du fichier lock
     *
     * @return void
     */
    public function putFileLock(): void
    {
        file_put_contents($this->fileLock, json_encode($this->encodeFileLock(), JSON_PRETTY_PRINT));
    }

    /**
     * Récuperation de la date de création du fichier de lock
     *
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * Récuperation de la date de modification du fichier de lock
     *
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * Implementation de la date de modification du fichier de lock
     *
     * @return FileLock
     */
    public function setDateUpdated(): FileLock
    {
        $this->dateUpdated = new \DateTime('now');
        return $this;
    }
}
