<?php

namespace ManageStudent\Service\FileModel;

use ManageStudent\Entity\Student;

class FileModelXLSX_ExportEtudiant extends FileModel implements FileModelInterface
{

    public static function analyse(array $structure): bool
    {
        // TODO faire le check model
        self::$arrFileModel = $structure;
        return true;
    }

    /**
     * @throws \Exception
     */
    public static function getStudents(): array
    {
        $tabStudent = [];

        foreach (self::$arrFileModel as $item => $student)

            if ($item !== 0) {
                $newStudent = new Student();
                $tabStudent[] = $newStudent->setNom($student[0])
                    ->setPrenom($student[1])
                    ->setStatut($student[3])
                    ->setNumero($student[4])
                    ->setDateNaissance(new \DateTime($student[2]));
            }

        return $tabStudent;
    }
}