<?php

namespace Studoo\Service;

use Studoo\Entity\Student;

/**
 * Class NomanclatureService
 * Gestion de la nomanclature des fichiers et dossiers
 *
 * @author Benoit Foujols
 */
class NomanclatureService
{
    /**
     * Nommage des repertoires
     *
     * @param Student $student
     * @return string
     */
    public function getNameWithoutType(Student $student): string
    {
        $clean = new StandardRaw();
        return $clean->normalizeSRString($student->getNom(), true)
            . "-" .
            $clean->normalizeSRSUcfirst($student->getPrenom(), true)
            . "-" .
            $this->getDateToString($student->getDateNaissance());
    }

    /**
     * Format des la date dans la nomenclature
     *
     * @param \DateTime $dateTime
     * @return string
     */
    public function getDateToString(\DateTime $dateTime): string
    {
        return $dateTime->format('ymd');
    }

}