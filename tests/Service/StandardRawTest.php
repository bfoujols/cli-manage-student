<?php

namespace Service;

use ManageStudent\Service\StandardRaw;
use PHPUnit\Framework\TestCase;

final class StandardRawTest extends TestCase
{
    /**
     * @return void
     * CODE STDRAW01
     */
    public function testStdRaw01IsString(): void
    {
        $raw = 'benjamin';

        $this->assertIsString(
            (new \ManageStudent\Service\StandardRaw)->normalizeSRString($raw)
        );
    }

    /**
     * @return void
     * CODE STDRAW02
     */
    public function testStdRaw02IsUpper(): void
    {
        $raw = 'benjamin';

        $this->assertSame(
            'BENJAMIN',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRString($raw)
        );
    }

    /**
     * @return void
     * CODE STDRAW03
     */
    public function testStdRaw03IsString(): void
    {
        $raw = 'benjamin';

        $this->assertIsString(
            (new \ManageStudent\Service\StandardRaw)->normalizeSRSUcfirst($raw)
        );
    }

    /**
     * @return void
     * CODE STDRAW04
     */
    public function testStdRaw04FirstUpper(): void
    {
        $raw = 'benjamin';

        $this->assertSame(
            'Benjamin',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRSUcfirst($raw)
        );
    }



}
