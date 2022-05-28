<?php


namespace app\Core;

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
     * http://patorjk.com/software/taag/#p=display&f=Digital&t=CRAWL%20YOOBIKE
     * @return string
     * @throws \Exception
     * @var $text string Add text in banner
     */
    private function setBanner(): ?String
    {
        $date = new \DateTime("now", new DateTimeZone("Europe/Paris"));
        $this->timeExecStart = $date;
        $this->timeExecStartMicro = microtime(true);

        $banner = "<info>+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+\n";

        $banner .= "    __  ___                                _____ __            __    \n";
        $banner .= "   /  |/  /___ _____  ____ _____ ____     / ___// /___  ______/ /     \n";
        $banner .= "  / /|_/ / __ `/ __ \/ __ `/ __ `/ _ \    \__ \/ __/ / / / __  /      \n";
        $banner .= " / /  / / /_/ / / / / /_/ / /_/ /  __/   ___/ / /_/ /_/ / /_/ /       \n";
        $banner .= "/_/  /_/\__,_/_/ /_/\__,_/\__, /\___/   /____/\__/\__,_/\__,_/        \n";
        $banner .= "                         /____/ </info><comment>by Benoit Foujols v1.0.0</comment>\n";
        $banner .= "<info>+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+</info>\n";

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
        $banner .= "<comment>Command launched : </comment>" . $this->commandName . "\n";
        $banner .= "<comment>Version : </comment>" . $this->commandVersion . "\n";
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
        } else {
            return round($diffMicro, 2) . " ms.";
        }
    }
}