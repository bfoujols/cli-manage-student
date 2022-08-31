<?php
/*
 * Ce fichier fait partie du Studoo.
 *
 * (c) Benoit Foujols <Benoit.Foujols@ac-creteil.fr>
 *
 * Pour les informations complètes sur les droits d'auteur et la licence,
 * veuillez consulter le fichier LICENSE qui a été distribué avec ce code source.
 */

namespace Studoo\Entity;

use Studoo\Exception\InvalideArgumentException;

/**
 * Import est la classe qui permet d'identifier les fichiers importations
 *
 * Les méthodes SET peuvent être en chainage :
 *
 *     $import = (new Import())->setId('52565255434')->setName('exemple.cvs');
 *
 * @author Benoit Foujols <Benoit.Foujols@ac-creteil.fr>
 *
 */
class Import
{
    private string $id;
    private string $name;
    private \DateTime $dateCreated;

    /**
     * Retourne l'ID du fichier d'importation
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Initialise ID du fichier d'importation
     *
     * @param string $id ID du fichier d'importation
     *
     * @throws InvalideArgumentException
     *
     * @return $this
     */
    public function setId(string $id): Import
    {

        if ($id === "" || strlen($id) !== 40) {
            throw new InvalideArgumentException("le format de l'ID est incorrect (Import::setId)");
        }
        $this->id = $id;
        return $this;
    }

    /**
     * Retourne le nom du fichier d'importation
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Initialise le nom du fichier d'importation
     *
     * @param string $name le nom du fichier d'importation
     *
     * @return $this
     *
     * @throws InvalideArgumentException
     */
    public function setName(string $name): Import
    {
        if ($name === "") {
            throw new InvalideArgumentException("le format du nom est incorrect (Import::setName)");
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Retourne la date du fichier d'importation
     *
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * Initialise la date du fichier d'importation
     *
     * @param \DateTime $dateTime TimeStamp du fichier d'importation
     *
     * @return $this
     */
    public function setDateCreated(\DateTime $dateTime): Import
    {
        $this->dateCreated = $dateTime;
        return $this;
    }
}