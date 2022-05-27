<?php

namespace app\Command;

use app\Core\CommandOption;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStudentCommand extends Command
{
    use CommandOption;

    protected static $defaultName = 'student:create';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $io->writeln($this->setBanner());
        $io->writeln([
            'Test Student::create',
        ]);


        return Command::SUCCESS;
    }
}