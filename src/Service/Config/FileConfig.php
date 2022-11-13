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

/**
 * Gestion des fichiers de configuration
 */
class FileConfig
{
    private string $fileName = "studoo";
    private string $extConfig = ".json";
    private string $extLock = ".lock";
    protected string $fileLock;
    protected string $fileConfig;
    protected string $formatDateTime = 'Y-m-d H:i:s';

    public function __construct()
    {
        $this->fileLock = $this->fileName . $this->extLock;
        $this->fileConfig = $this->fileName . $this->extConfig;
    }

}
