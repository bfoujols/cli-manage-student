<?php

namespace Studoo\Command;

use Studoo\Entity\Student;
use Studoo\Service\Command\CommandBanner;
use Studoo\Service\FileSystem\Dir;
use Studoo\Service\FileSystem\FileLoader;
use Studoo\Service\FileSystem\FileSelector;
use Studoo\Service\FileSystem\FileSource;
use Studoo\Service\NomanclatureService;
use Studoo\Service\Config\FileLock;
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
        $fileLock->setImport(FileSource::getFilePath());

        foreach (FileLoader::execute() as $student) {
            if ($student instanceof Student) {
                $nameDir = new NomanclatureService();
                $newDir = new Dir();
                $nameRepository = $nameDir->getNameWithoutType($student);
                $idStudent = $nameDir->getHashForId($student, true);

                if ($newDir->createDir($nameRepository) === true) {
                    $fileLock->setRepository($idStudent, $nameRepository);
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