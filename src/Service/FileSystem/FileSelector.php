<?php

namespace ManageStudent\Service\FileSystem;

use ManageStudent\Service\chemin;
use ManageStudent\Service\Command\QuestionType;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class FileSelector
 * Gestion pour selectionner le fichier input
 *
 * @author Benoit Foujols
 */
class FileSelector
{
    private $input;
    private $output;
    private $fileSelected;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * Recuperation du fichier input
     *
     * @param $path chemin du dossier du fichier input
     * @return SplFileInfo
     */
    public function getFile($path): SplFileInfo
    {
        $file = new FinderType((string) $path);
        if ($path === null) {
            $file->setPath($file->getPathCurrent());
        }

        $choiceFile = new QuestionType($this->input, $this->output);
        $finalChoiseFile = $choiceFile->Choice("Quel fichier source pour cette action ?", $file->getFileListAccept(), 'Merci de choisir un fichier');
        return $this->fileSelected = $file->setFileSelected($finalChoiseFile);
    }

}