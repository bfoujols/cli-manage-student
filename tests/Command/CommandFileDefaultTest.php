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
        $this->commandeTester->execute([]);
        $this->assertSame(
            "ee5cda1ffec25948635f53ed8ca6e6e8fc5c37b1a5e99cea37cbf35a0c0284c2",
            hash("sha256", $this->commandeTester->getDisplay())
        );
    }

    /**
     * @test FileDefault02
     */
    public function testCommandeFileDefaultExist(): void
    {
        $this->commandeTester->execute([]);
        $this->assertSame(
            "7cfcb3b700fd406b24ef39b7196e276e2881349996fbafc25d59ba203f84834e",
            hash("sha256", $this->commandeTester->getDisplay())
        );
        // Purge du fichier tester
        (new Filesystem())->remove("liste-etudiant.xlsx");
    }
}

