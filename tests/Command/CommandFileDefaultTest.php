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
            "4cf886e7c52c2d3987099df7b3026e5edc6ecf93b6ec3818c34d1ecb890e91da",
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
            "3d3c98d44c27170a3ae07851161c2ce40e929e0d6e88e943596674ef0c2f2cea",
            hash("sha256", $this->commandeTester->getDisplay())
        );
        // Purge du fichier tester
        (new Filesystem())->remove("liste-etudiant.xlsx");
    }
}

