<?php

namespace ManageStudent\Command;

use ManageStudent\Core\CommandOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DefaultCommand extends Command
{
    use CommandOption;

    protected static $defaultName = 'default';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->writeln($this->setBanner());
        $io->writeln([
            'Bonjour !',
        ]);
        $io->writeln([
            'Pour voir toutes les commandes, run: mstud list',
        ]);



        return Command::SUCCESS;
    }
}