<?php

use PHPUnit\Framework\TestCase;

final class FileExtensionTest extends TestCase
{
    /**
     * CODE testArray
     */
    public function testIsArray() : void
    {
        $this->assertIsArray(
            \ManageStudent\Service\FileExtension::getListExtensionByName()
        );
    }

    /**
     * CODE testValueArray
     */
    public  function  testArrayTypeXlsx() : void
    {
        $listExtension = \ManageStudent\Service\FileExtension::getListExtensionByName();
        var_dump($listExtension);

        $this->assertSame('*.XLSX', $listExtension[0]
        );
    }
}

