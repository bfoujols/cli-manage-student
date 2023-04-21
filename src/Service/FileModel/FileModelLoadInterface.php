<?php

namespace Studoo\Service\FileModel;

interface FileModelLoadInterface
{
    /**
     * Renvoi une liste des class model pour charger le fichier selectionne
     *
     * @return array
     */
    public function getListFileModel(): array;
}
