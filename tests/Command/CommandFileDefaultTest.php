<?php

namespace Command;

use Studoo\Command\CreateFileDefaultCommand;
use Studoo\Service\Command\CommandBanner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

final class CommandFileDefaultTest extends TestCase
{
    private $commandeTester;

    protected function setUp(): void
    {
        $application = new Application("Manage Student CLI", "0.2.0@alpha");
        CommandBanner::setVersion($application->getVersion());
        $application->add(new CreateFileDefaultCommand());
        $command = $application->find("file:default");
        $this->commandeTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        $this->commandeTester = null;
    }

    /**
     * @test FileDefault01
     */
    public function testCommandeFileDefaultCreated(): void
    {
        $this->commandeTester->setInputs(['0']);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('[*] Le fichier est créé liste-etudiant.xlsx', $output);
    }

    /**
     * @test FileDefault02
     */
    public function testCommandeFileDefaultExist(): void
    {
        $this->commandeTester->setInputs(['0']);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('[X] Le fichier est deja present dans le repertoire', $output);
        // Purge du fichier tester
        (new Filesystem())->remove("liste-etudiant.xlsx");
    }
}

