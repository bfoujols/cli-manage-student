<?php

namespace ManageStudent\Entity;

class Student extends \DateTime
{
    private string $nom;
    private string $prenom;
    private \DateTime $dateNaissance;
    private string $statut;
    private string $numero;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Student
     */
    public function setNom(string $nom): Student
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Student
     */
    public function setPrenom(string $prenom): Student
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateNaissance(): \DateTime
    {
        return $this->dateNaissance;
    }

    /**
     * @param \DateTime $dateNaissance
     * @return Student
     */
    public function setDateNaissance(\DateTime $dateNaissance): Student
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatut(): string
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     * @return Student
     */
    public function setStatut(string $statut): Student
    {
        $this->statut = $statut;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumero(): string
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     * @return Student
     */
    public function setNumero(string $numero): Student
    {
        $this->numero = $numero;
        return $this;
    }
}