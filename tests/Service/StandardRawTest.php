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

    /**
     * @return void
     * CODE STDRAW05
     */
    public function testStdRaw05IsClean(): void
    {
        $raw = 'áàâãªäÁÀÂÃÄÍÌÎÏíìîïéèêëÉÈÊËóòôõºöÓÒÔÕÖúùûüÚÙÛÜçÇñÑ–’‘‹›‚“”«»„ .';

        $this->assertSame(
            'aaaaaaAAAAAIIIIiiiieeeeEEEEooooooOOOOOuuuuUUUUcCnN------------',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw)
        );
    }

    /**
     * @return void
     * CODE STDRAW06
     */
    public function testStdRaw06IsCleanToSpace(): void
    {
        $raw = 'áàâãªäÁÀÂÃÄÍÌÎÏíìîïéèêëÉÈÊËóòôõºöÓÒÔÕÖúùûüÚÙÛÜçÇñÑ–’‘‹›‚“”«»„ .';

        $this->assertSame(
            'aaaaaaAAAAAIIIIiiiieeeeEEEEooooooOOOOOuuuuUUUUcCnN            ',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, false, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW07
     */
    public function testStdRaw07IsCleanBeginSpace(): void
    {
        $raw = '      Benoit';

        $this->assertSame(
            'Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW08
     */
    public function testStdRaw08IsCleanEndSpace(): void
    {
        $raw = 'Benoit     ';

        $this->assertSame(
            'Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW09
     */
    public function testStdRaw09IsCleanBeginEndSpace(): void
    {
        $raw = '    Benoit     ';

        $this->assertSame(
            'Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW10
     */
    public function testStdRaw10IsCleanBeginEndAddHyphen(): void
    {
        $raw = '    Jean Benoit     ';

        $this->assertSame(
            'Jean-Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW11
     */
    public function testStdRaw11IsCleanBeginEndAndDelSpace(): void
    {
        $raw = '    Jean Benoit     ';

        $this->assertSame(
            'Jean Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW12
     */
    public function testStdRaw12IsCleanBeginEndAndOffDelHyphen(): void
    {
        $raw = '    Jean-Benoit     ';

        $this->assertSame(
            'Jean-Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true)
        );
    }

    /**
     * @return void
     * CODE STDRAW13
     */
    public function testStdRaw13IsCleanBeginEndAndDelHyphen(): void
    {
        $raw = '    Jean-Benoit     ';

        $this->assertSame(
            'Jean Benoit',
            (new \ManageStudent\Service\StandardRaw)->normalizeSRUtf8($raw, true, true)
        );
    }
}
