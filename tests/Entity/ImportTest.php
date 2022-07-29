<?php

namespace Entity;

use ManageStudent\Entity\Import;
use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase
{
    /**
     * @return void
     * CODE IMPORT01
     */
    public function testImport01SetIdNotNull(): void
    {
        $import = new Import();
        $import->setId("7f529863602e23a93a550b47433338f9940f88ee");

        $this->assertEquals(
            '7f529863602e23a93a550b47433338f9940f88ee',
            $import->getId()
        );
    }

    /**
     * @return void
     * CODE IMPORT02
     */
    public function testImport02SetIdIsBool(): void
    {
        $import = new Import();
        $import->setId("");

        $this->assertIsBool(
            $import->getId()
        );
    }

    /**
     * @return void
     * CODE IMPORT03
     */
    public function testImport03SetIdIsFalse(): void
    {
        $import = new Import();
        $import->setId("");

        $this->assertFalse(
            $import->getId()
        );
    }


}
