<?php

namespace Service;

use ManageStudent\Service\FileSystem\Dir;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

final class DirServiceTest extends TestCase
{
    /**
     * @return void
     * CODE DIR01
     */
    public function testDir01IsCreated(): void
    {
        $this->assertTrue(
            (new Dir())->createDir("TEST-DIR")
        );
    }

    /**
     * @return void
     * CODE DIR02
     */
    public function testDir02IsExists(): void
    {
        $this->assertFalse(
            (new Dir())->createDir("TEST-DIR")
        );

        // Purge du fichier tester
        $fileSystem = new Filesystem();
        $fileSystem->remove("TEST-DIR");
    }
}
