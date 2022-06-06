<?php

namespace ManageStudent\Service;

/**
 * Class FileExtension
 * Gestion des formats des fichiers
 *
 * @author Benoit Foujols
 */
class FileExtension
{
    private const EXT_LIST_ACCEPT = [
        'XLSX'
    ];

    /**
     * Liste des extensions comptatibles avec le format *.<ext>
     * Exemple : *.xlsx
     *
     * @return array
     */
    public static function getListExtensionByName(): array
    {
        $listExt = [];
        foreach (self::EXT_LIST_ACCEPT as $ext) {
            $listExt[] = '*.' . strtolower($ext);
        }

        return $listExt;
    }

}