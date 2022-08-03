<?php

namespace Studoo\Service\FileModel;

use DateTime;
use Studoo\Command\CommandManage;
use Studoo\Entity\Student;
use Studoo\Exception\DateInvalideErrorException;
use Studoo\Service\Date;
use Studoo\Service\StandardRaw;

class FileModelXLSXFileAcademique extends FileModel implements FileModelInterface
{

    public function analyse(array $structure): bool
    {
        $state = false;

        if (str_contains($structure[1][0], "Listes simples") === true
            && str_contains($structure[4][0], "Code Spécialité") === true
            && str_contains($structure[8][0], "N° Candidat") === true
            && str_contains($structure[8][1], "Nom de famille") === true
            && str_contains($structure[8][2], "Prénom(s)") === true
            && str_contains($structure[8][3], "Date de Naissance") === true) {

            self::$arrFileModel = $structure;
            $state = true;
        }

        return $state;
    }

    /**
     * @throws DateInvalideErrorException|\Exception
     */
    public function getStudents(): array
    {
        $tabStudent = [];

        foreach (self::$arrFileModel as $item => $student) {
            try {
                if ($item >= 9) {
                    $newStudent = new Student();
                    $newStudent->setPrenom($student[2]);
                    $newStudent->setNom($student[1]);

                    if ((new Date())->isValid($student[3], "Y-m-d H:i:s") === false) {
                        throw new DateInvalideErrorException();
                    }
                    $newStudent->setDateNaissance(new \DateTime($student[3]));

                    $tabStudent[] = $newStudent;
                }
            } catch (DateInvalideErrorException $exception) {
                CommandManage::getStdOutPut()->writeln($exception->getMessage() . " FileModelXLSXFileAcademique(" . $student[1] . ") ERR100 ");
            }
        }

        return $tabStudent;
    }

    public function getNameModel(): string
    {
        return "Fichier XLSX Export by Academique";
    }

}