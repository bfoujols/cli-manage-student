<?php

namespace ManageStudent\Command;

use ManageStudent\Service\Command\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

class CreateFileDefaultCommand extends Command
{
    protected static $defaultName = 'file:default';
    protected static $defaultDescription = 'Création du fichier par défaut';


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $render = new SymfonyStyle($input, $output);
        $render->writeln(CommandBanner::getBanner());
        $render->writeln([
            'Command : ' . self::$defaultName
        ]);

        $filesystem = new Filesystem();
        if ($filesystem->exists(getcwd() . "/liste-etudiant.xlsx")) {
            $render->writeln([
                '',
                '<error>[X] Le fichier est deja present dans le repertoire</error>',
                ''
            ]);
        } else {
            $filesystem->copy(__DIR__ . "/../../ressources/liste-etudiant.xlsx", getcwd() . "/liste-etudiant.xlsx");
            $render->writeln([
                '',
                '<info>[*] Le fichier est créé liste-etudiant.xlsx</info>',
                ''
            ]);
        }

        return Command::SUCCESS;
    }
}