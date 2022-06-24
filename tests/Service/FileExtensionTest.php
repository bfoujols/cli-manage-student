<?php

namespace Service;

use PHPUnit\Framework\TestCase;

final class FileExtensionTest extends TestCase
{
    /**
     * CODE FileExt01
     */
    public function testFileExt01IsArray(): void
    {
        $this->assertIsArray(
            \ManageStudent\Service\FileSystem\FileExtension::getListExtensionByName()
        );
    }

    /**
     * CODE FileExt02
     */
    public function testFileExt02ArrayTypeXlsx(): void
    {
        $listExtension = \ManageStudent\Service\FileSystem\FileExtension::getListExtensionByName();
        $this->assertSame(
            '*.xlsx',
            $listExtension[0]
        );
    }
}

