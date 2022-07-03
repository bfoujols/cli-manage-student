<?php

namespace ManageStudent\Command;

use ManageStudent\Service\CkeckStack;
use ManageStudent\Service\listCommand;
use ManageStudent\Service\Command\CommandBanner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DefaultCommand extends Command
{
    protected static $defaultName = 'default';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $render = new SymfonyStyle($input, $output);
        $render->writeln(CommandBanner::getBanner());
        $render->writeln([
            'Bienvenu dans la console Manage Student !',
            ''
        ]);

        $check = new listCommand($output, $render);
        $check->render();

        $check = new CkeckStack($output, $render);
        $check->render();

        $render->writeln([
            'Si vous avez un problème, https://github.com/bfoujols/manage-student-cli/discussions',
            ''
        ]);

        return Command::SUCCESS;
    }
}