<?php


namespace ManageStudent\Core;

use DateTime;
use DateTimeZone;

trait CommandOption
{
    /**
     * @var DateTime
     */
    private $timeExecStart;
    private $timeExecStartMicro;

    /**
     * Banner of the command
     * @return string
     * @throws \Exception
     * @var $text string Add text in banner
     */
    private function setBanner(): ?String
    {
        $date = new \DateTime("now", new DateTimeZone("Europe/Paris"));
        $this->timeExecStart = $date;
        $this->timeExecStartMicro = microtime(true);

        $banner = "<info>";
        $banner .= " __  __                           ___ _           _    \n";
        $banner .= "|  \/  |__ _ _ _  __ _ __ _ ___  / __| |_ _  _ __| |   \n";
        $banner .= "| |\/| / _` | ' \/ _` / _` / -_) \__ \  _| || / _` |   \n";
        $banner .= "|_|  |_\__,_|_||_\__,_\__, \___| |___/\__|\_,_\__,_|   \n";
        $banner .= "                      |___/ </info><comment>v1.0.0</comment>";

        return $banner;
    }

    /**
     * Footer of the command
     * @return String|null
     * @throws \Exception
     */
    private function setEnd(): ?String
    {
        $banner = "\n<info>+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+</info>\n";
        $banner .= "<comment>Command launched : </comment> \n";
        $banner .= "<comment>Version : </comment> \n";
        $banner .= "<comment>Running time : </comment>" . $this->execTime() . "\n";
        $banner .= "<info>+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+</info>\n";

        return $banner;
    }

    /**
     * Calculate Exec Time Command
     * @return String|null
     * @throws \Exception
     */
    private function execTime(): ?String
    {
        // Calcul Seconde
        $dateEnd = new \DateTime("now", new DateTimeZone($_ENV['TIMEZONE']));
        $dateDiff = $this->timeExecStart->diff($dateEnd);
        // Calcul MS
        $diffMicro = microtime(true) - $this->timeExecStartMicro;

        if ($diffMicro > 1) {
            $ms = explode(".", $diffMicro);
            return $dateDiff->format("%H:%I:%S") . "(" . substr($ms[1], 0, 3) . "ms)";
        }

        return round($diffMicro, 2) . " ms.";
    }
}