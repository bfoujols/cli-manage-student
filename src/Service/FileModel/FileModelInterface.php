<?php

namespace ManageStudent\Service\FileModel;

interface FileModelInterface
{
    /**
     * Analyse du model proposer
     *
     * @return bool
     */
    public static function analyse(array $structure): bool;

    /**
     * Liste des étudiants student::class
     *
     * @return array
     */
    public static function getStudents(): array;
}