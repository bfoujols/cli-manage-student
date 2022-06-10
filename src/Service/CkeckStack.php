<?php

namespace ManageStudent\Service;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CkeckStack
{
    private $output;
    private $symfonyStyle;

    public function __construct(OutputInterface $output, SymfonyStyle $symfonyStyle)
    {
        $this->output = $output;
        $this->symfonyStyle = $symfonyStyle;
    }

    public function render()
    {
        $this->symfonyStyle->writeln([
            'Check List Stack : ',
        ]);
        $table = new Table($this->output);
        $table
            ->setHeaders(['CHECK', 'SERVICE', 'VERSION'])
            ->setRows($this->run())
        ;
        $table->render();
        $this->symfonyStyle->writeln([
            '',
        ]);
    }

    private function run(): array
    {
        $listCheck = [];

        (version_compare(PHP_VERSION, '7.4', '<') === true) ? $listCheck[] = ["OK", 'PHP', PHP_VERSION] : $listCheck[] = ["KO", 'PHP', PHP_VERSION];
        $listCheck[] = ["INFO", 'PHP', PHP_BINARY];

        return $listCheck;
    }
}