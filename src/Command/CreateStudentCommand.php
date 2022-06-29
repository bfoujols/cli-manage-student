<?php

namespace ManageStudent\Command;

use ManageStudent\Entity\Student;
use ManageStudent\Service\Command\CommandBanner;
use ManageStudent\Service\FileSystem\DirService;
use ManageStudent\Service\FileSystem\FileLoader;
use ManageStudent\Service\FileSystem\FileSelector;
use ManageStudent\Service\FileSystem\FileSource;
use ManageStudent\Service\NomanclatureService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateStudentCommand extends Command
{

    protected static $defaultName = 'student:dir';
    protected static $defaultDescription = 'Création des repertoires des étudiants';

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'Chemin du dossier source');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $render = new SymfonyStyle($input, $output);
        $render->writeln(CommandBanner::getBanner());
        $render->writeln([
            'Command : ' . self::$defaultName
        ]);

        $fileSelect = new FileSelector($input, $output);
        FileSource::setFileSource($fileSelect->getFile($input->getArgument('path')));

        foreach (FileLoader::execute() as $student)
        {
            if ($student instanceof Student) {
                $nameDir = new NomanclatureService();
                $newDir = new DirService();
                ($newDir->createDir($nameDir->getNameWithoutType($student)) === true) ? $result = "Creation du repertoire " : $result = "Repertoire deja existant ";
                $render->writeln($result . $nameDir->getNameWithoutType($student));
            }
        }

        return Command::SUCCESS;
    }
}