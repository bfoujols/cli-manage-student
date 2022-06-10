<?php

namespace ManageStudent\Command;

use ManageStudent\Service\CkeckStack;
use ManageStudent\Service\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DefaultCommand extends Command
{
    use CommandBanner;

    protected static $defaultName = 'default';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->writeln($this->setBanner("Command: " . self::$defaultName));
        $io->writeln([
            'Bienvenu dans la console Manage Student !',
            ''
        ]);

        $check = new CkeckStack($output, $io);
        $check->render();

        $io->writeln([
            'Pour voir toutes les commandes, run: mstud list',
            ''
        ]);

        return Command::SUCCESS;
    }
}