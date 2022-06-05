<?php

namespace ManageStudent\Command;

use ManageStudent\Service\CommandBanner;
use ManageStudent\Service\FileSelect;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStudentCommand extends Command
{
    use CommandBanner;

    protected static $defaultName = 'student:create';
    protected static $defaultDescription = 'Création des repertoires des étudiants';

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'Chemin du dossier source');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $io->writeln($this->setBanner());
        $io->writeln([
            '',
            'Command: Student::create',
        ]);

        $fileSelect = new FileSelect($input, $output);
        $fileSelected = $fileSelect->getFilePath($input->getArgument('path'));



        return Command::SUCCESS;
    }
}