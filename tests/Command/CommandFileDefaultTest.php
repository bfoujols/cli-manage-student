<?php

namespace Command;

use ManageStudent\Command\CreateFileDefaultCommand;
use ManageStudent\Service\CommandBanner;
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
            "714c97e495b7fee2dec4ce66002cca273394feb7787f7800aa15dd9d4d9b86b6",
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
            "25a208a6a0bc6b597b0e26d5076ba08adb3a28993e58ceafba41e4465c991150",
            hash("sha256", $this->commandeTester->getDisplay())
        );
        // Purge du fichier tester
        (new Filesystem())->remove("liste-etudiant.xlsx");
    }
}

