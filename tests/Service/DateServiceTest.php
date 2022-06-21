<?php

namespace Service;

use ManageStudent\Service\DateService;
use PHPUnit\Framework\TestCase;

final class DateServiceTest extends TestCase
{
    /**
     * @return void
     * CODE DATE01
     */
    public function testDate01IsValid(): void
    {
        $this->assertIsBool(
            (new DateService())->isValid("2020-01-30")
        );
    }

    /**
     * @return void
     * CODE DATE02
     */
    public function testDate02IsNotValid(): void
    {
        $this->assertIsBool(
            (new DateService())->isValid("2020-30-01")
        );
    }

    /**
     * @return void
     * CODE DATE03
     */
    public function testDate03IsTrueWithFormat(): void
    {
        $this->assertTrue(
            (new DateService())->isValid("2020/01/30", "Y/m/d")
        );
    }

    /**
     * @return void
     * CODE DATE04
     */
    public function testDate04IsFalseWithoutFormat(): void
    {
        $this->assertFalse(
            (new DateService())->isValid("2020/30/01")
        );
    }

    /**
     * @return void
     * CODE DATE05
     */
    public function testDate05IsNotValideDayWithFormat(): void
    {
        $this->assertFalse(
            (new DateService())->isValid("2020/30/01", "Y/m/d")
        );
    }

    /**
     * @return void
     * CODE DATE06
     */
    public function testDate06IsNotValideYearDouble(): void
    {
        $this->assertFalse(
            (new DateService())->isValid("20/30/01", "Y/m/d")
        );
    }
}
