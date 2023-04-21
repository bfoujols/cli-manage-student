<?php

namespace Studoo\Service\FileModel;

use Studoo\Command\CommandManage;
use Studoo\Entity\Student;
use Studoo\Exception\DateInvalideErrorException;
use Studoo\Service\Date;

class FileModelXLSXFileDefault extends FileModel implements FileModelInterface
{
    public function analyse(array $structure): bool
    {
        $state = false;
        if ($structure[0][0] === "Nom de famille"
            && $structure[0][1] === "Prenom(s)"
            && $structure[0][2] === "Date de Naissance"
            && $structure[0][3] === "Categorie Candidat"
            && $structure[0][4] === "N Candidat") {

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
                if ($item !== 0) {
                    $newStudent = new Student();
                    $newStudent->setNom($student[0])
                        ->setPrenom($student[1])
                        ->setStatut($student[3])
                        ->setNumero($student[4]);

                    if ((new Date())->isValid($student[2], "Y-m-d H:i:s") === false) {
                        throw new DateInvalideErrorException();
                    }
                    $newStudent->setDateNaissance(new \DateTime($student[2]));
                    $tabStudent[] = $newStudent;
                }
            } catch (DateInvalideErrorException $exception) {
                CommandManage::getStdOutPut()->writeln($exception->getMessage() . " (" . $student[2] . ") ERR101 ");
            }
        }

        return $tabStudent;
    }

    public function getNameModel(): string
    {
        return "Fichier XLSX par défaut";
    }
}
