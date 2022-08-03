<?php

namespace Studoo\Service\FileType;

use Studoo\Exception\NoTypeErrorException;
use Studoo\Service\FileSystem\FileSource;
use Shuchkin\SimpleXLSX;

/**
 * Class FileTypeXLSX
 * Gestion du format MS XLSX
 *
 * @author Benoit Foujols
 */
class FileTypeXLSX implements FileTypeInterface
{
    public function getContent(): array
    {
        try {
            if ($xlsx = SimpleXLSX::parse(FileSource::getFilePath())) {
                return $xlsx->rows();
            }
            throw new NoTypeErrorException();

        } catch (NoTypeErrorException $exception) {
            printf("%s (%s) ERR%u \n", $exception->getMessage(), SimpleXLSX::parseError(), "200");
        }
    }
}