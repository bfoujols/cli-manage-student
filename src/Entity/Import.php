<?php

namespace Studoo\Entity;

use Studoo\Exception\InvalideArgumentException;

class Import
{
    private string $id;
    private string $name;
    private \DateTime $dateCreated;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Import
     * @throws InvalideArgumentException
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
     * @return string|false
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Import
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
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return Import
     */
    public function setDateCreated(\DateTime $dateTime): Import
    {
        $this->dateCreated = $dateTime;
        return $this;
    }
}