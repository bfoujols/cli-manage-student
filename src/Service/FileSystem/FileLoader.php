<?php

namespace Studoo\Service\FileSystem;

use Studoo\Command\CommandManage;
use Studoo\Exception\NoTypeErrorException;

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
            $FileTypeLoader = 'Studoo\Service\FileType\FileType' . FileSource::getFileExtension();
            $exeFileType = new $FileTypeLoader();

            $FileModelLoader = 'Studoo\Service\FileModel\FileModelLoad' . FileSource::getFileExtension();
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
            CommandManage::getStdOutPut()->writeln($exception->getMessage() . " (" . FileSource::getFilePath() . ") ERR300");
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