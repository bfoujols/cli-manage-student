<?php


namespace ManageStudent\Service;

/**
 * Class StandardRaw
 *
 * @author Benoit Foujols
 */
class StandardRaw
{
    /**
     * Normalize to Standard Raw String
     * Rules Raw -> Clean -> Upper -> Raw (Standard)
     * @param String $raw
     * @return String|null
     */
    public function normalizeSRString(String $raw): ?String
    {
        return strtoupper($this->clean($raw));
    }

    /**
     * Normalize to Standard Raw UTF8
     * Rules Raw -> Clean -> Raw (Normal)
     * @param String $raw
     * @return String|null
     */
    public function normalizeSRSUcfirst(String $raw): ?String
    {
        return ucfirst($this->clean($raw));
    }


    /**
     * Normalize to Standard Raw UTF8
     * Rules Raw -> Clean -> Raw (Normal)
     * @param String $raw
     * @return String|null
     */
    public function normalizeSRUtf8(String $raw): ?String
    {
        return $this->clean($raw);
    }

    /**
     * Clean String UTF8 to Normal
     * @param String $text
     * @return String|null
     */
    private function clean(String $text): ?String
    {
        $utf8 = array(
            '/[áàâãªä]/u' => 'a',
            '/[ÁÀÂÃÄ]/u' => 'A',
            '/[ÍÌÎÏ]/u' => 'I',
            '/[íìîï]/u' => 'i',
            '/[éèêë]/u' => 'e',
            '/[ÉÈÊË]/u' => 'E',
            '/[óòôõºö]/u' => 'o',
            '/[ÓÒÔÕÖ]/u' => 'O',
            '/[úùûü]/u' => 'u',
            '/[ÚÙÛÜ]/u' => 'U',
            '/ç/' => 'c',
            '/Ç/' => 'C',
            '/ñ/' => 'n',
            '/Ñ/' => 'N',
            '/–/' => '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u' => ' ', // Literally a single quote
            '/[“”«»„]/u' => ' ', // Double quote
            '/ /' => '-', // nonbreaking space (equiv. to 0x160)
            '/[.]/' => '',
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $text);
    }
}