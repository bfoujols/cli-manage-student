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

use Studoo\Service\CkeckStack;
use Studoo\Service\listCommand;
use Studoo\Service\Command\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Commande par defaut qui affiche
 * - la liste des commandes
 * - information sur l'environnement
 *
 * Commande : studoo
 *
 */
class DefaultCommand extends CommandManage
{
    protected static $defaultName = 'default';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Bienvenu dans la console STUDOO !',
            ''
        ]);

        $check = new listCommand($output, self::$stdOutput);
        $check->render();

        $check = new CkeckStack($output, self::$stdOutput);
        $check->render();

        self::$stdOutput->writeln([
            'Si vous avez un problème, https://github.com/bfoujols/studoo/discussions',
            ''
        ]);

        return Command::SUCCESS;
    }
}