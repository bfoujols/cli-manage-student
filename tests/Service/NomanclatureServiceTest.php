<?php

namespace Service;

use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class NomanclatureServiceTest extends TestCase
{

    /**
     * @test FileNom01
     */
    public function testNom01DateToString() : void
    {
        $student = new \ManageStudent\Entity\Student();
        $dateNow = new DateTime('2017-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);
        $this->assertIsString(
            (new \ManageStudent\Service\NomanclatureService)->getDateToString($student->getDateNaissance())
        );
    }

    /**
     * @test FileNom02
     */
    public function testNom02IsString() : void
    {
        $student = new \ManageStudent\Entity\Student();
        $student->setNom("Ort");
        $student->setPrenom("Montreuil");
        $dateNow = new DateTime('2017-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertIsString(
            (new \ManageStudent\Service\NomanclatureService)->getNameWithoutType($student)
        );

    }

    /**
     * @test FileNom03
     */
    public function testNom03WhithoutType() : void
    {
        $student = new \ManageStudent\Entity\Student();

        $student->setNom("Ort");
        $student->setPrenom("Montreuil");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "ORT-Montreuil-801017",
            (new \ManageStudent\Service\NomanclatureService)->getNameWithoutType($student)
        );
    }
}
