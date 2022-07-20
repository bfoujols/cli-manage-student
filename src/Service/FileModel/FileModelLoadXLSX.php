<?php

namespace ManageStudent\Service\FileModel;

class FileModelLoadXLSX implements FileModelLoadInterface
{
    public function getListFileModel(): array
    {
        return [
            \ManageStudent\Service\FileModel\FileModelXLSXFileDefault::class,
            \ManageStudent\Service\FileModel\FileModelXLSXFileEcoleDirecte::class,
            \ManageStudent\Service\FileModel\FileModelXLSXFileAcademique::class
        ];
    }
}