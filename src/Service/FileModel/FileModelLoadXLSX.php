<?php

namespace Studoo\Service\FileModel;

class FileModelLoadXLSX implements FileModelLoadInterface
{
    public function getListFileModel(): array
    {
        return [
            \Studoo\Service\FileModel\FileModelXLSXFileDefault::class,
            \Studoo\Service\FileModel\FileModelXLSXFileEcoleDirecte::class,
            \Studoo\Service\FileModel\FileModelXLSXFileAcademique::class
        ];
    }
}
