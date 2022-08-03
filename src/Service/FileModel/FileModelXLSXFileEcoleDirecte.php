<?php

namespace Studoo\Service\FileModel;

use DateTime;
use Studoo\Command\CommandManage;
use Studoo\Entity\Student;
use Studoo\Exception\DateInvalideErrorException;
use Studoo\Service\Date;
use Studoo\Service\StandardRaw;

class FileModelXLSXFileEcoleDirecte extends FileModel implements FileModelInterface
{

    public function analyse(array $structure): bool
    {
        $state = false;

        if (str_contains($structure[0][0], "Edité le") === true
            && str_contains($structure[0][4], "Année scolaire") === true
            && str_contains($structure[2][1], "Classe") === true
            && str_contains($structure[4][1], "Effectif") === true) {

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
                if ($item >= 7) {
                    $newStudent = new Student();
                    $newStudent = $this->splitStudentName($student[0], $newStudent);

                    if ((new Date())->isValid($student[1], "d/m/Y") === false) {
                        throw new DateInvalideErrorException();
                    }
                    $newStudent->setDateNaissance(DateTime::createFromFormat("d/m/Y", $student[1]));

                    $tabStudent[] = $newStudent;
                }
            } catch (DateInvalideErrorException $exception) {
                CommandManage::getStdOutPut()->writeln($exception->getMessage() . " FileModelXLSXFileEcoleDirecte(" . $student[1] . ") ERR100 ");
            }
        }

        return $tabStudent;
    }

    public function getNameModel(): string
    {
        return "Fichier XLSX Export by Ecole Directe";
    }

    /**
     * @param string $fullName
     * @param Student $student
     * @return Student
     */
    private function splitStudentName(string $fullName, Student $student): Student
    {
        $nom = "";
        $prenom = "";

        // Split avec un espace les mots
        $tabName = explode(" ", (new StandardRaw())->normalizeSRUtf8($fullName, false, true));
        // Boucle pour trier le mot en majuscule (nom) et miniscule (Prenom)
        foreach ($tabName as $nameRaw) {
            (preg_match('/^[A-Z0-9]+$/', $nameRaw)) ?
                $nom .= " " . $nameRaw :
                $prenom .= " " . $nameRaw;
        }

        $student->setPrenom($prenom)->setNom($nom);

        return $student;
    }
}