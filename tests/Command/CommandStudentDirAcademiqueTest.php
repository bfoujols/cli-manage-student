<?php

namespace Command;

use ManageStudent\Command\CreateStudentCommand;
use ManageStudent\Service\Command\CommandBanner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

final class CommandStudentDirAcademiqueTest extends TestCase
{
    private $commandeTester;
    private $fileExport = ['export-etudiant-academique.xlsx'];

    protected function setUp(): void
    {
        $application = new Application("Manage Student CLI", "0.5.0@alpha");
        CommandBanner::setVersion($application->getVersion());
        $application->add(new CreateStudentCommand());
        $command = $application->find("student:dir");
        $this->commandeTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        $this->commandeTester = null;
        (new Filesystem())->remove("mstud.lock");
    }

    /**
     * @test StudDir01
     */
    public function testCommandeStudDirCreated(): void
    {
        $this->commandeTester->setInputs($this->fileExport);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('Fichier XLSX Export by Academique', $output);

        $this->assertStringContainsString('Creation du repertoire AMETYUAL-Ben-dror-010409', $output);
        $this->assertStringContainsString('Creation du repertoire FOU-BEL-Samuel-020319', $output);
        $this->assertStringContainsString('Creation du repertoire JEAN-PAUL-Ruben-simon-isaac-000320', $output);
        $this->assertStringContainsString('Creation du repertoire GUIGUI-Jean-paul-010831', $output);
    }

    /**
     * @test StudDir02
     */
    public function testCommandeStudDirExist(): void
    {
        $this->commandeTester->setInputs($this->fileExport);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('Fichier XLSX Export by Academique', $output);

        $this->assertStringContainsString('Repertoire deja existant AMETYUAL-Ben-dror-010409', $output);
        $this->assertStringContainsString('Repertoire deja existant FOU-BEL-Samuel-020319', $output);
        $this->assertStringContainsString('Repertoire deja existant JEAN-PAUL-Ruben-simon-isaac-000320', $output);
        $this->assertStringContainsString('Repertoire deja existant GUIGUI-Jean-paul-010831', $output);

        // Purge du fichier tester
        $fileSystem = new Filesystem();
        $fileSystem->remove("FOU-BEL-Samuel-020319");
        $fileSystem->remove("GUIGUI-Jean-paul-010831");
    }

    /**
     * @test StudDir03
     */
    public function testCommandeStudDirRemoveAndCreate(): void
    {
        $this->commandeTester->setInputs($this->fileExport);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('Fichier XLSX Export by Academique', $output);

        $this->assertStringContainsString('Repertoire deja existant AMETYUAL-Ben-dror-010409', $output);
        $this->assertStringContainsString('Creation du repertoire FOU-BEL-Samuel-020319', $output);
        $this->assertStringContainsString('Repertoire deja existant JEAN-PAUL-Ruben-simon-isaac-000320', $output);
        $this->assertStringContainsString('Creation du repertoire GUIGUI-Jean-paul-010831', $output);

        // Purge du fichier tester
        $fileSystem = new Filesystem();
        $fileSystem->remove("AMETYUAL-Ben-dror-010409");
        $fileSystem->remove("FOU-BEL-Samuel-020319");
        $fileSystem->remove("JEAN-PAUL-Ruben-simon-isaac-000320");
        $fileSystem->remove("GUIGUI-Jean-paul-010831");
    }

}

