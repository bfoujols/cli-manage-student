<?php

namespace ManageStudent\Service\FileModel;

use ManageStudent\Entity\Student;
use ManageStudent\Exception\DateInvalideErrorException;
use ManageStudent\Service\DateService;

class FileModelXLSX_ExportEtudiant extends FileModel implements FileModelInterface
{

    public static function analyse(array $structure): bool
    {
        // TODO faire le check model
        self::$arrFileModel = $structure;
        return true;
    }

    /**
     * @throws DateInvalideErrorException|\Exception
     */
    public static function getStudents(): array
    {
        $tabStudent = [];

        foreach (self::$arrFileModel as $item => $student) {
            try {
                if ($item !== 0) {
                    $newStudent = new Student();
                    $tabStudent[] = $newStudent->setNom($student[0])
                        ->setPrenom($student[1])
                        ->setStatut($student[3])
                        ->setNumero($student[4]);
                    if ((new DateService())->isValid($student[2], "Y-m-d H:i:s") === true) {
                        $newStudent->setDateNaissance(new \DateTime($student[2]));
                    } else {
                        throw new DateInvalideErrorException();
                    }
                }
            } catch (DateInvalideErrorException $exception) {
                // Todo Exception
                echo "Date invalide " . $student[2];
                exit;
            }
        }

        return $tabStudent;
    }
}