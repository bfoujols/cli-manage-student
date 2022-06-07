<?php

namespace ManageStudent\Command;

use ManageStudent\Service\CommandBanner;
use ManageStudent\Service\FileLoader;
use ManageStudent\Service\FileSelector;
use ManageStudent\Service\FileSource;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStudentCommand extends Command
{
    use CommandBanner;

    protected static $defaultName = 'student:dir';
    protected static $defaultDescription = 'Création des repertoires des étudiants';

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'Chemin du dossier source');
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $io->writeln($this->setBanner("Command: " . self::$defaultName));


        $fileSelect = new FileSelector($input, $output);
        FileSource::setFileSource($fileSelect->getFile($input->getArgument('path')));

        $result = FileLoader::execute();
        print_r($result);

        return Command::SUCCESS;
    }
}