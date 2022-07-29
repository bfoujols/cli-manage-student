<?php

namespace ManageStudent\Entity;

use phpDocumentor\Reflection\Types\Boolean;

class Import
{
    private string $id;
    private string $name;
    private \DateTime $dateCreated;

    /**
     * @return string|false
     */
    public function getId()
    {
        return ($this->id === "") ? false : $this->id;
    }

    /**
     * @param string $id
     * @return Import
     */
    public function setId(string $id): Import
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|false
     */
    public function getName()
    {
        return ($this->name === "") ? false : $this->name;
    }

    /**
     * @param string $name
     * @return Import
     */
    public function setName(string $name): Import
    {
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