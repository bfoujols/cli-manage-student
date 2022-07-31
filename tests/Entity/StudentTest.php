<?php

namespace Entity;

use DateTime;
use DateTimeZone;
use ManageStudent\Entity\Student;
use PHPUnit\Framework\TestCase;

final class StudentTest extends TestCase
{
    /**
     * @return void
     * CODE STUD01
     */
    public function testStud01NomWithoutSpace(): void
    {
        $student = new Student();
        $student->setNom("Bonneau");

        $this->assertEquals(
            'Bonneau',
            $student->getNom()
        );
    }

    /**
     * @return void
     * CODE STUD02
     */
    public function testStud02NomWithSpace(): void
    {
        $student = new Student();
        $student->setNom("Bonneau Paul");

        $this->assertEquals(
            'Bonneau Paul',
            $student->getNom()
        );
    }

    /**
     * @return void
     * CODE STUD03
     */
    public function testStud03PrenomWithoutSpace(): void
    {
        $student = new Student();
        $student->setPrenom("Anne");

        $this->assertEquals(
            'Anne',
            $student->getPrenom()
        );
    }

    /**
     * @return void
     * CODE STUD04
     */
    public function testStud04PrenomWithSpace(): void
    {
        $student = new Student();
        $student->setPrenom("Anne Marie");

        $this->assertEquals(
            'Anne Marie',
            $student->getPrenom()
        );
    }

    /**
     * @return void
     * CODE STUD05
     */
    public function testStud05DateNaissanceToFormatEurope(): void
    {
        $student = new Student();
        $dateNow = new DateTime("2022/12/30", new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertEquals(
            '30/12/2022',
            $student->getDateNaissance()->format("d/m/Y")
        );
    }

    /**
     * @return void
     * CODE STUD06
     */
    public function testStud06DateNaissance(): void
    {
        $student = new Student();
        $dateNow = new DateTime("2022/12/30");
        $student->setDateNaissance($dateNow);

        $this->assertEquals(
            '30/12/2022',
            $student->getDateNaissance()->format("d/m/Y")
        );
    }

    /**
     * @return void
     * CODE STUD07
     */
    public function testStud07Statut(): void
    {
        $student = new Student();
        $student->setStatut("INITIAL");

        $this->assertSame(
            "INITIAL",
            $student->getStatut()
        );
    }

    /**
     * @return void
     * CODE STUD08
     */
    public function testStud08Numero(): void
    {
        $student = new Student();
        $student->setNumero("034543245543");

        $this->assertSame(
            "034543245543",
            $student->getNumero()
        );
    }

}
