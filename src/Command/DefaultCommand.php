<?php

namespace Studoo\Command;

use Studoo\Service\CkeckStack;
use Studoo\Service\listCommand;
use Studoo\Service\Command\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DefaultCommand extends CommandManage
{
    protected static $defaultName = 'default';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Bienvenu dans la console Manage Student !',
            ''
        ]);

        $check = new listCommand($output, self::$stdOutput);
        $check->render();

        $check = new CkeckStack($output, self::$stdOutput);
        $check->render();

        self::$stdOutput->writeln([
            'Si vous avez un problème, https://github.com/bfoujols/manage-student-cli/discussions',
            ''
        ]);

        return Command::SUCCESS;
    }
}