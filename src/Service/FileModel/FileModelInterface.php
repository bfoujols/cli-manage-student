<?php

namespace Studoo\Service\FileModel;

interface FileModelInterface
{
    /**
     * Analyse du model proposer
     *
     * @return bool
     */
    public function analyse(array $structure): bool;

    /**
     * Liste des étudiants student::class
     *
     * @return array
     */
    public function getStudents(): array;

    /**
     * Retourne le nom du modele selectionne
     *
     * @return string
     */
    public function getNameModel(): string;
}
