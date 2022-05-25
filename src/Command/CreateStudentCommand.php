<?php

namespace app\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateStudentCommand extends Command
{
    protected static $defaultName = 'student:create';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $output->writeln([
            'Test Student',
            '============',
        ]);


        return Command::SUCCESS;
    }
}