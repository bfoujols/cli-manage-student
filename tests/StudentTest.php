<?php

use PHPUnit\Framework\TestCase;

final class StudentTest extends TestCase
{
    public function testNomWithoutSpace(): void
    {
        $student = new \ManageStudent\Entity\Student();
        $student->setNom("Bonneau");

        $this->assertEquals(
            'Bonneau',
            $student->getNom()
        );
    }

    public function testNomWithSpace(): void
    {
        $student = new \ManageStudent\Entity\Student();
        $student->setNom("Bonneau Paul");

        $this->assertEquals(
            'Bonneau Paul',
            $student->getNom()
        );
    }

    public function testPrenomWithoutSpace(): void
    {
        $student = new \ManageStudent\Entity\Student();
        $student->setPrenom("Anne");

        $this->assertEquals(
            'Anne',
            $student->getPrenom()
        );
    }

    public function testPrenomWithSpace(): void
    {
        $student = new \ManageStudent\Entity\Student();
        $student->setPrenom("Anne Marie");

        $this->assertEquals(
            'Anne Marie',
            $student->getPrenom()
        );
    }

//    public function testDateNaissanceToFormatEurope(): void
//    {
//        $student = new \ManageStudent\Entity\Student();
//        $dateNow = new DateTime("30/12/2022", new DateTimeZone('Europe/Paris'));
//        $student->setDateNaissance($dateNow);
//
//        $this->assertEquals(
//            '30/12/2022',
//            $student->getDateNaissance()->format("d/m/Y")
//        );
//    }
//
//    public function testDateNaissanceToFormatUs(): void
//    {
//        $student = new \ManageStudent\Entity\Student();
//        $dateNow = new DateTime("2022/12/30");
//        $student->setDateNaissance($dateNow);
//
//        $this->assertEquals(
//            '30/12/2022',
//            $student->getDateNaissance()->format("d/m/Y")
//        );
//    }

}
