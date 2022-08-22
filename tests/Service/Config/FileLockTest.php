<?php

namespace Service\Config;

use ManageStudent\Service\Config\FileLock;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class FileLockTest extends TestCase
{

    protected function tearDown(): void
    {
        (new Filesystem())->remove("mstud.lock");
    }

    /**
     * @return void
     */
    public function testFileLockCreated(): void
    {
        $fileLockCreated = new FileLock();
        $fileLockCreated->createFileLock();
        $fileLockCreated->putFileLock();

        $this->assertFileExists("mstud.lock");
    }

    public function testFileLockImportFileIsObject(): void
    {
        $fileLockCreated = new FileLock();
        $fileLockCreated->createFileLock();
        $fileLockCreated->setImport("List-testing.csv");
        $fileLockCreated->putFileLock();

        $fileLock = (new FileLock())->createFileLock();

        $this->assertIsObject(array_values($fileLock->getListImport())[0]);
    }

    public function testFileLockImportFileGetName(): void
    {
        $fileLockCreated = new FileLock();
        $fileLockCreated->createFileLock();
        $fileLockCreated->setImport("List-testing.csv");
        $fileLockCreated->putFileLock();

        $fileLock = (new FileLock())->createFileLock();

        $this->assertSame(
            "List-testing.csv",
            array_values($fileLock->getListImport())[0]->getName()
            );
    }

    public function testFileLockRepositoryIsObject(): void
    {
        $fileLockCreated = new FileLock();
        $fileLockCreated->createFileLock();
        $fileLockCreated->setRepository("835b2356868e9b37e6e8eca4b71e86dc4548baa1", "Benoit-Paul-020202");
        $fileLockCreated->putFileLock();

        $fileLock = (new FileLock())->createFileLock();

        $this->assertIsObject(array_values($fileLock->getListRepository() )[0]);
    }

    public function testFileLockRepositoryGetName(): void
    {
        $fileLockCreated = new FileLock();
        $fileLockCreated->createFileLock();
        $fileLockCreated->setRepository("835b2356868e9b37e6e8eca4b71e86dc4548baa1", "Benoit-Paul-020202");
        $fileLockCreated->putFileLock();

        $fileLock = (new FileLock())->createFileLock();

        $this->assertSame(
            "Benoit-Paul-020202",
            array_values($fileLock->getListRepository())[0]->getName()
        );
    }

}
