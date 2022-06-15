<?php

use PHPUnit\Framework\TestCase;

final class FileExtensionTest extends TestCase
{
    /**
     * @test FileExt01
     */
    public function testIsArray() : void
    {
        $this->assertIsArray(
            \ManageStudent\Service\FileExtension::getListExtensionByName()
        );
    }

    /**
     * @test FileExt02
     */
    public  function  testArrayTypeXlsx() : void
    {
        $listExtension = \ManageStudent\Service\FileExtension::getListExtensionByName();
                $this->assertSame(
                        '*.XLSX',
                        $listExtension[0]
        );
    }
}

