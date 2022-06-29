<?php

namespace ManageStudent\Service\FileType;

use Exception;
use ManageStudent\Service\FileSystem\FileSource;
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
            } else {
                // Todo gestion des errors MITRE, CWE-397 - Declaration of Throws for Generic Exception
                throw new Exception(SimpleXLSX::parseError());
            }
        } catch (\Exception $exception) {
            echo "Une erreur s'est produite lors de la lecture de votre fichier";
        }
    }
}