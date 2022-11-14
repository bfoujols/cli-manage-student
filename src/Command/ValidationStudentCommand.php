<?php
/*
 * Ce fichier fait partie du projet Studoo.
 *
 * (c) Benoit Foujols <Benoit.Foujols@ac-creteil.fr>
 *
 * Pour les informations complètes sur les droits d'auteur et la licence,
 * veuillez consulter le fichier LICENSE qui a été distribué avec ce code source.
 */

namespace Studoo\Command;

use Studoo\Service\Command\CommandBanner;
use Studoo\Service\Config\FileLock;
use Studoo\Service\FileSystem\FinderType;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Commande qui liste les informations des étudiants. Celle-ci va charger les informations dans le fichier lock qui enregistre les informations post-import
 *
 * Commande : studoo student:list
 * Argument : studoo student:list [<path>]
 */
class ValidationStudentCommand extends CommandManage
{
    protected static $defaultName = 'student:list';
    protected static $defaultDescription = 'Liste des étudiants';

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'Chemin du dossier source');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Command : ' . self::$defaultName
        ]);

        $path = $input->getArgument('path');
        $file = new FinderType((string)$path);
        if ($path === null) {
            $file->setPath($file->getPathCurrent());
        }

        // TODO mettre condition exist
        $config = new FileLock($path);

        self::$stdOutput->writeln([
            'Path : ' . $file->getPath()
        ]);


        return Command::SUCCESS;

    }
}