<?php

namespace ManageStudent\Service\FileType;

use ManageStudent\Service\FileSource;
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
        if ($xlsx = SimpleXLSX::parse(FileSource::getFilePath())) {
            return $xlsx->rows();
        } else {
            // Todo gestion des errors
            // SimpleXLSX::parseError();
        }
    }
}