<?php

namespace Studoo\Service\FileSystem;

use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FileSource
 * Gestion du fichier selectionne
 *
 * @author Benoit Foujols
 */
class FileSource
{
    private static $SplFileInfo = null;

    /**
     * Init le fichier selectionne
     *
     * @param SplFileInfo $fileInfo
     * @return SplFileInfo
     */
    public static function setFileSource(SplFileInfo $fileInfo): SplFileInfo
    {
        return self::$SplFileInfo = $fileInfo;
    }

    /**
     * Renvoi l'objet <SplFileInfo> selectionne
     *
     * @return SplFileInfo
     */
    public static function getFileSource(): SplFileInfo
    {
       return self::$SplFileInfo;
    }

    /**
     * Renvoi le path du fichier selectionne
     *
     * @return string
     */
    public static function getFilePath(): string
    {
        return self::$SplFileInfo->getPath() . '/' . self::$SplFileInfo->getFilename();
    }

    /**
     * Renvoi l'extention du fichier en MAJUSCULE
     *
     * @return string
     */
    public static function getFileExtension(): string
    {
        return strtoupper(self::$SplFileInfo->getExtension());
    }


}