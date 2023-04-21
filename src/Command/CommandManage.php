<?php
/*
 * Ce fichier fait partie du Studoo.
 *
 * (c) Benoit Foujols <Benoit.Foujols@ac-creteil.fr>
 *
 * Pour les informations complètes sur les droits d'auteur et la licence,
 * veuillez consulter le fichier LICENSE qui a été distribué avec ce code source.
 */

namespace Studoo\Command;

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
        if ($output->isVerbose()) {
            error_reporting($output->isDebug() ? E_ALL : E_ALL & ~E_DEPRECATED);
        } elseif ($output->isQuiet()) {
            error_reporting(false);
        }

        self::$stdOutput = new SymfonyStyle($input, $output);
    }

    public static function getStdOutPut(): SymfonyStyle
    {
        return self::$stdOutput;
    }

}
