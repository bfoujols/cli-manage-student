<?php

namespace ManageStudent\Service;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FileLoader
 *
 * @author Benoit Foujols
 */
class FileLoader
{
    /**
     * Execution du loader pour charger la class du bon format
     *
     * @return array
     */
    public static function execute(): array
    {
        $classLoader = 'ManageStudent\Service\FileType\FileType'.FileSource::getFileExtension();
        $exe = new $classLoader();
        return $exe->getContent();
    }

}