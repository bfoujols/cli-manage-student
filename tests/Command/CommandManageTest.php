<?php

namespace Command;

use Studoo\Command\CommandManage;
use PHPUnit\Framework\TestCase;

class CommandManageTest extends TestCase
{
    private $CommandManage;

    protected function setUp(): void
    {
        $this->CommandManage = new CommandManage();
    }

    /**
     * @test CommandManage01
     */
    public function testCommandeManage(): void
    {
        $this->assertIsObject($this->CommandManage);
    }

}
