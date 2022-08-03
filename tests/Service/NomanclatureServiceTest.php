<?php

namespace Service;

use DateTime;
use DateTimeZone;
use Studoo\Entity\Student;
use Studoo\Service\NomanclatureService;
use PHPUnit\Framework\TestCase;

class NomanclatureServiceTest extends TestCase
{

    /**
     * @test FileNom01
     */
    public function testNom01DateToString(): void
    {
        $student = new Student();
        $student->setDateNaissance((new DateTime('2017-10-17', new DateTimeZone('Europe/Paris'))));
        $this->assertIsString(
            (new NomanclatureService)->getDateToString($student->getDateNaissance())
        );
    }

    /**
     * @test FileNom02
     */
    public function testNom02IsString() : void
    {
        $student = new Student();
        $student->setNom("Babutta");
        $student->setPrenom("Tom");
        $student->setDateNaissance((new DateTime('2017-10-17', new DateTimeZone('Europe/Paris'))));

        $this->assertIsString(
            (new NomanclatureService)->getNameWithoutType($student)
        );

    }

    /**
     * @test FileNom03
     */
    public function testNom03WhithoutType() : void
    {
        $student = new Student();

        $student->setNom("Babutta");
        $student->setPrenom("Tom");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABUTTA-Tom-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom04
     */
    public function testNom04FullUpper(): void
    {
        $student = new Student();

        $student->setNom("BABUTTA");
        $student->setPrenom("TOM");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABUTTA-Tom-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom05
     */
    public function testNom05FullLower(): void
    {
        $student = new Student();

        $student->setNom("babutta");
        $student->setPrenom("tom");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABUTTA-Tom-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom06
     */
    public function testNom06WhitoutBlank(): void
    {
        $student = new Student();

        $student->setNom(" Babutta");
        $student->setPrenom("Tom");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABUTTA-Tom-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom07
     */
    public function testNom07WhitoutBlank(): void
    {
        $student = new Student();

        $student->setNom("Babu tta");
        $student->setPrenom("Tom");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABU-TTA-Tom-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom08
     */
    public function testNom08WhitoutManyBlank(): void
    {
        $student = new Student();

        $student->setNom("  Babutta ");
        $student->setPrenom(" Tom  ");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABUTTA-Tom-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom09
     */
    public function testNom09ComposeName(): void
    {
        $student = new Student();

        $student->setNom("Babu tta");
        $student->setPrenom("Tom Louis");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABU-TTA-Tom-louis-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

    /**
     * @test FileNom10
     */
    public function testNom10ComposeNameWhitoutBlankBeginEnd(): void
    {
        $student = new Student();

        $student->setNom("  Babu tta  ");
        $student->setPrenom("  Tom Louis  ");

        $dateNow = new DateTime('1980-10-17', new DateTimeZone('Europe/Paris'));
        $student->setDateNaissance($dateNow);

        $this->assertSame(
            "BABU-TTA-Tom-louis-801017",
            (new NomanclatureService)->getNameWithoutType($student)
        );
    }

}
