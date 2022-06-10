<?php

namespace ManageStudent\Service;

use ManageStudent\Entity\Student;

class NomanclatureService
{
    public function getNameWithoutType(Student $student): string
    {
        return StandardRaw::normalizeSRString($student->getNom())
            . "-" .
            StandardRaw::normalizeSRSUcfirst($student->getPrenom())
            . "-" .
            $this->getDateToString($student->getDateNaissance());
    }

    public function getDateToString(\DateTime $dateTime): string
    {
        return $dateTime->format('ymd');
    }

}