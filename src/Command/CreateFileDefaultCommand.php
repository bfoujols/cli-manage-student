<?php

namespace Studoo\Command;

use Studoo\Service\Command\CommandBanner;
use Studoo\Service\Command\QuestionType;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class CreateFileDefaultCommand extends CommandManage
{
    protected static $defaultName = 'file:default';
    protected static $defaultDescription = 'Création du fichier par défaut';
    private $fileDefaut = array(
        "0" => "Fichier liste des étudiants au format XLSX"
    );
    private $fileDefautConfig = array(
        "0" => [
            "file" => "liste-etudiant.xlsx",
            "fileRessource" => "/../../ressources/liste-etudiant.xlsx"
        ]
    );


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Command : ' . self::$defaultName
        ]);

        $choiceFile = new QuestionType($input, $output);
        $finalChoiseFile = $choiceFile->Choice("Quel fichier par défaut, voulez vous ?", $this->fileDefaut, 'Merci de choisir un fichier');
        $keyFileDefaut = array_search($finalChoiseFile, $this->fileDefaut);


        if (array_key_exists($keyFileDefaut, $this->fileDefautConfig)) {
            $filesystem = new Filesystem();
            if ($filesystem->exists(getcwd() . "/" . $this->fileDefautConfig[$keyFileDefaut]["file"])) {
                self::$stdOutput->writeln([
                    '',
                    '<error>[X] Le fichier est deja present dans le repertoire</error>',
                    ''
                ]);
                return Command::SUCCESS;
            }

            $filesystem->copy(__DIR__ . $this->fileDefautConfig[$keyFileDefaut]["fileRessource"], getcwd() . "/" . $this->fileDefautConfig[$keyFileDefaut]["file"]);
            self::$stdOutput->writeln([
                '',
                '<info>[*] Le fichier est créé ' . $this->fileDefautConfig[$keyFileDefaut]["file"] . '</info>',
                ''
            ]);
            return Command::SUCCESS;
        }
        return Command::FAILURE;
    }
}
