<?php

namespace Entity;

use DateTime;
use DateTimeZone;
use http\Exception;
use ManageStudent\Entity\Import;
use ManageStudent\Exception\InvalideArgumentException;
use PHPUnit\Framework\TestCase;

class ImportTest extends TestCase
{
    /**
     * @return void
     * CODE IMPORT01
     * @throws \ManageStudent\Exception\InvalideArgumentException
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
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testImport02SetIdIsEmpty(): void
    {
        $import = new Import();
        $this->expectExceptionMessage("le format de l'ID est incorrect (Import::setId)");
        $import->setId("");
    }

    /**
     * @return void
     * CODE IMPORT03
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testImport03SetIdNotValide(): void
    {
        $import = new Import();
        $this->expectExceptionMessage("le format de l'ID est incorrect (Import::setId)");
        $import->setId("23a93a550b4743333");
    }

    /**
     * @return void
     * CODE IMPORT04
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testImport04SetNameValide(): void
    {
        $import = new Import();
        $import->setName("Benoit");
        $this->assertEquals(
            'Benoit',
            $import->getName()
        );
    }

    /**
     * @return void
     * CODE IMPORT05
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testImport05SetNameIsEmpty(): void
    {
        $import = new Import();
        $this->expectExceptionMessage("le format du nom est incorrect (Import::setName)");
        $import->setName("");
    }

    /**
     * @return void
     * CODE IMPORT06
     * @throws \Exception
     */
    public function testImport06SetDateIsValide(): void
    {
        $import = new Import();
        $import->setDateCreated(new DateTime("2022/12/30", new DateTimeZone('Europe/Paris')));

        $this->assertEquals(
            '30/12/2022',
            $import->getDateCreated()->format("d/m/Y")
        );
    }

    /**
     * @return void
     * CODE IMPORT07
     * @throws \Exception
     */
    public function testImport07SetDateIsNotValideMois(): void
    {
        $import = new Import();
        $this->expectException(\Exception::class);
        $import->setDateCreated(new DateTime("2022/13/30", new DateTimeZone('Europe/Paris')));
    }

    /**
     * @return void
     * CODE IMPORT08
     * @throws \Exception
     */
    public function testImport08SetDateIsNotValideAnnee(): void
    {
        $import = new Import();
        $this->expectException(\Exception::class);
        $import->setDateCreated(new DateTime("22/11/30", new DateTimeZone('Europe/Paris')));
    }
}
