<?php

namespace ManageStudent\Entity;

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
     */
    public function setId(string $id): Import
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function setDateCreated(): Import
    {
        $this->dateCreated = new \DateTime('now');
        return $this;
    }
}