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
    private static $FileModelSelect;

    /**
     * Execution du loader pour charger la class du bon format
     *
     * @return array
     */
    public static function execute(): array
    {
        $FileTypeLoader = 'ManageStudent\Service\FileType\FileType'.FileSource::getFileExtension();
        $exeFileType = new $FileTypeLoader();

        $FileModelLoader = 'ManageStudent\Service\FileModel\FileModelLoad'.FileSource::getFileExtension();
        $exeFileModel = new $FileModelLoader();
        foreach ($exeFileModel->getListFileModel() as $FileModel) {
            $ModelClass = new $FileModel;
            if ($ModelClass->analyse($exeFileType->getContent()) === true) {
                self::$FileModelSelect = $ModelClass;
                break;
            }
        }
        return self::$FileModelSelect->getStudents();
    }

    /**
     * Retourne le model selectionne par l'analyse
     *
     * @return mixed
     */
    public static function getModelSelected()
    {
        return self::$FileModelSelect;
    }

}