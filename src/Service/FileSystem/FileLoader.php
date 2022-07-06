<?php

namespace ManageStudent\Service\FileSystem;

use ManageStudent\Command\CommandManage;
use ManageStudent\Exception\NoTypeErrorException;

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
        try {
            $FileTypeLoader = 'ManageStudent\Service\FileType\FileType' . FileSource::getFileExtension();
            $exeFileType = new $FileTypeLoader();

            $FileModelLoader = 'ManageStudent\Service\FileModel\FileModelLoad' . FileSource::getFileExtension();
            $exeFileModel = new $FileModelLoader();
            foreach ($exeFileModel->getListFileModel() as $FileModel) {
                $ModelClass = new $FileModel;
                if ($ModelClass->analyse($exeFileType->getContent()) === true) {
                    self::$FileModelSelect = $ModelClass;
                    CommandManage::getStdOutPut()->writeln($ModelClass->getNameModel());

                    return self::$FileModelSelect->getStudents();
                }
            }

            throw new NoTypeErrorException();

        } catch (NoTypeErrorException $exception) {
            printf("%s (%s) ERR%u \n", $exception->getMessage(), FileSource::getFilePath(), "300");
        }

        return [];
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