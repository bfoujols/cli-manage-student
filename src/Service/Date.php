<?php

namespace Studoo\Service;

use DateTime;

/**
 * Class Date
 * Gestion des dates
 *
 * @author Benoit Foujols
 */
class Date
{
    /**
     * Validation de la date au niveau de son format
     *
     * @param string $date
     * @param string $format
     * @return bool
     */
    public function isValid(string $date, string $format = 'Y-m-d'): bool
    {
        $newFormat = DateTime::createFromFormat($format, $date);
        return $newFormat && $newFormat->format($format) === $date;
    }


}
