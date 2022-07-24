<?php

namespace ManageStudent\Command;

use ManageStudent\Entity\Student;
use ManageStudent\Service\Command\CommandBanner;
use ManageStudent\Service\Config\FileLock;
use ManageStudent\Service\FileSystem\Dir;
use ManageStudent\Service\FileSystem\FileLoader;
use ManageStudent\Service\FileSystem\FileSelector;
use ManageStudent\Service\FileSystem\FileSource;
use ManageStudent\Service\NomanclatureService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateStudentCommand extends CommandManage
{

    protected static $defaultName = 'student:dir';
    protected static $defaultDescription = 'Création des repertoires des étudiants';

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::OPTIONAL, 'Chemin du dossier source');
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        self::$stdOutput->writeln([
            CommandBanner::getBanner(),
            'Command : ' . self::$defaultName
        ]);

        $fileSelect = new FileSelector($input, $output);
        FileSource::setFileSource($fileSelect->getFile($input->getArgument('path')));

        CommandManage::getStdOutPut()->writeln([
            'Vous avez selectionné le fichier suivant : ',
            FileSource::getFilePath()
        ]);

        $fileLock = (new FileLock())->createFileLock();

        foreach (FileLoader::execute() as $student) {
            if ($student instanceof Student) {
                $nameDir = new NomanclatureService();
                $newDir = new Dir();
                $nameRepository = $nameDir->getNameWithoutType($student);
                if ($newDir->createDir($nameRepository) === true) {
                    $fileLock->setRepository($nameRepository, true);
                    $result = "Creation du repertoire ";
                } else {
                    $result = "Repertoire deja existant ";
                }

                self::$stdOutput->writeln($result . $nameDir->getNameWithoutType($student));
            }
        }

        $fileLock->putFileLock();

        return Command::SUCCESS;
    }
}