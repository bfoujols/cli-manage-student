<?php

namespace Command;

use ManageStudent\Command\CreateStudentCommand;
use ManageStudent\Service\Command\CommandBanner;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

final class CommandStudentDirTest extends TestCase
{
    private $commandeTester;

    protected function setUp(): void
    {
        $application = new Application("Manage Student CLI", "0.2.0@alpha");
        CommandBanner::setVersion($application->getVersion());
        $application->add(new CreateStudentCommand());
        $command = $application->find("student:dir");
        $this->commandeTester = new CommandTester($command);
    }

    protected function tearDown(): void
    {
        $this->commandeTester = null;
    }

    /**
     * @test StudDir01
     */
    public function testCommandeStudDirCreated(): void
    {
        $this->commandeTester->setInputs(['export-etudiant.xlsx']);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('Creation du repertoire PIERRE-Or-el-000729', $output);
        $this->assertStringContainsString('Creation du repertoire BELHASSEN-Meir-moshe-020626', $output);
        $this->assertStringContainsString('Creation du repertoire BALAGRIYAN-Athittyanab-010828', $output);
        $this->assertStringContainsString('Creation du repertoire AZIZA-Moise-021030', $output);
        $this->assertStringContainsString('Creation du repertoire ASSOU-Ilan-990715', $output);
        $this->assertStringContainsString('Creation du repertoire ARZO-Amelie-010925', $output);
        $this->assertStringContainsString('Creation du repertoire ABECA-Ben-deborah-000830', $output);
        $this->assertStringContainsString('Creation du repertoire BEN-ADMONE-Martin-010531', $output);

    }

    /**
     * @test StudDir02
     */
    public function testCommandeStudDirExist(): void
    {
        $this->commandeTester->setInputs(['export-etudiant.xlsx']);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('Repertoire deja existant PIERRE-Or-el-000729', $output);
        $this->assertStringContainsString('Repertoire deja existant BELHASSEN-Meir-moshe-020626', $output);
        $this->assertStringContainsString('Repertoire deja existant BALAGRIYAN-Athittyanab-010828', $output);
        $this->assertStringContainsString('Repertoire deja existant AZIZA-Moise-021030', $output);
        $this->assertStringContainsString('Repertoire deja existant ASSOU-Ilan-990715', $output);
        $this->assertStringContainsString('Repertoire deja existant ARZO-Amelie-010925', $output);
        $this->assertStringContainsString('Repertoire deja existant ABECA-Ben-deborah-000830', $output);
        $this->assertStringContainsString('Repertoire deja existant BEN-ADMONE-Martin-010531', $output);

        // Purge du fichier tester
        $fileSystem = new Filesystem();
        $fileSystem->remove("BEN-ADMONE-Martin-010531");
        $fileSystem->remove("AZIZA-Moise-021030");
    }

    /**
     * @test StudDir03
     */
    public function testCommandeStudDirRemoveAndCreate(): void
    {
        $this->commandeTester->setInputs(['export-etudiant.xlsx']);
        $this->commandeTester->execute([]);
        $output = $this->commandeTester->getDisplay();

        $this->assertStringContainsString('Repertoire deja existant PIERRE-Or-el-000729', $output);
        $this->assertStringContainsString('Repertoire deja existant BELHASSEN-Meir-moshe-020626', $output);
        $this->assertStringContainsString('Repertoire deja existant BALAGRIYAN-Athittyanab-010828', $output);
        $this->assertStringContainsString('Creation du repertoire AZIZA-Moise-021030', $output);
        $this->assertStringContainsString('Repertoire deja existant ASSOU-Ilan-990715', $output);
        $this->assertStringContainsString('Repertoire deja existant ARZO-Amelie-010925', $output);
        $this->assertStringContainsString('Repertoire deja existant ABECA-Ben-deborah-000830', $output);
        $this->assertStringContainsString('Creation du repertoire BEN-ADMONE-Martin-010531', $output);

        // Purge du fichier tester
        $fileSystem = new Filesystem();
        $fileSystem->remove("PIERRE-Or-el-000729");
        $fileSystem->remove("BELHASSEN-Meir-moshe-020626");
        $fileSystem->remove("BALAGRIYAN-Athittyanab-010828");
        $fileSystem->remove("AZIZA-Moise-021030");
        $fileSystem->remove("ASSOU-Ilan-990715");
        $fileSystem->remove("ARZO-Amelie-010925");
        $fileSystem->remove("ABECA-Ben-deborah-000830");
        $fileSystem->remove("BEN-ADMONE-Martin-010531");
    }

}

