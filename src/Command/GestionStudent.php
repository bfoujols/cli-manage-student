<?php

namespace Studoo\Command;

use Studoo\Service\Command\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GestionStudent extends CommandManage
{
    protected static $defaultName = 'student:info';
    protected static $defaultDescription = 'Liste des étudiants suite aux imports';


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Command : ' . self::$defaultName
        ]);


        return Command::SUCCESS;
    }
}