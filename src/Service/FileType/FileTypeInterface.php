<?php

namespace Studoo\Service\FileType;

/**
 * Class FileTypeInterface
 * Gestion des formats des fichiers
 *
 * @author Benoit Foujols
 */
interface FileTypeInterface
{
    /**
     * Renvoi le contenu du fichier telecharge
     * @return array
     */
    public function getContent(): array;

}
