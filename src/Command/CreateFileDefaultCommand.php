<?php

namespace ManageStudent\Command;

use ManageStudent\Service\Command\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class CreateFileDefaultCommand extends CommandManage
{
    protected static $defaultName = 'file:default';
    protected static $defaultDescription = 'Création du fichier par défaut';


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Command : ' . self::$defaultName
        ]);

        $filesystem = new Filesystem();
        if ($filesystem->exists(getcwd() . "/liste-etudiant.xlsx")) {
            self::$stdOutput->writeln([
                '',
                '<error>[X] Le fichier est deja present dans le repertoire</error>',
                ''
            ]);
            return Command::SUCCESS;
        }

        $filesystem->copy(__DIR__ . "/../../ressources/liste-etudiant.xlsx", getcwd() . "/liste-etudiant.xlsx");
        self::$stdOutput->writeln([
            '',
            '<info>[*] Le fichier est créé liste-etudiant.xlsx</info>',
            ''
        ]);
        return Command::SUCCESS;
    }
}