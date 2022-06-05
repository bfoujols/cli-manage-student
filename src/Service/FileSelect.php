<?php

namespace ManageStudent\Service;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;

class FileSelect
{
    private $input;
    private $output;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    public function getFilePath($path): SplFileInfo
    {
        $file = new FinderType((string) $path);
        if ($path === null) {
            $file->setPath($file->getPathCurrent());
        }

        $choiceFile = new QuestionType($this->input, $this->output);
        $finalChoiseFile = $choiceFile->Choice("Quel fichier source pour cette action ?", $file->getFileListAccept(), 'Merci de choisir un fichier');
        return $file->setFileSelected($finalChoiseFile);
    }
}