<?php

namespace ManageStudent\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CommandManage extends Command
{
    protected static SymfonyStyle $stdOutput;

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        // Debug mode
        ini_set('display_errors', '0');
        if ($output->isVerbose()) {
            error_reporting($output->isDebug() ? E_ALL : E_ALL & ~E_DEPRECATED);
            ini_set('display_errors', 'stderr');
        } elseif ($output->isQuiet()) {
            error_reporting(false);
        } else {
            error_reporting(E_PARSE | E_ERROR);
        }

        self::$stdOutput = new SymfonyStyle($input, $output);
    }

    public static function getStdOutPut(): SymfonyStyle
    {
        return self::$stdOutput;
    }

}