<?php

namespace Entity;

use DateTime;
use DateTimeZone;
use Studoo\Entity\Repository;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    /**
     * @return void
     * CODE REPO01
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testRepository01SetIdNotNull(): void
    {
        $repository = new Repository();
        $repository->setId("Benoit-Paul-0220222");

        $this->assertEquals(
            '835b2356868e9b37e6e8eca4b71e86dc4548baa1',
            $repository->getId()
        );
    }

    /**
     * @return void
     * CODE REPO02
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testRepository02SetNameValide(): void
    {
        $repository = new Repository();
        $repository->setName("Benoit");
        $this->assertEquals(
            'Benoit',
            $repository->getName()
        );
    }

    /**
     * @return void
     * CODE REPO03
     * @throws \ManageStudent\Exception\InvalideArgumentException
     */
    public function testRepository03SetNameIsEmpty(): void
    {
        $repository = new Repository();
        $this->expectExceptionMessage("le format du nom est incorrect (Repository::setName)");
        $repository->setName("");
    }

    /**
     * @return void
     * CODE REPO04
     * @throws \Exception
     */
    public function testRepository04SetDateIsValide(): void
    {
        $repository = new Repository();
        $repository->setDateCreated(new DateTime("2022/12/30", new DateTimeZone('Europe/Paris')));

        $this->assertEquals(
            '30/12/2022',
            $repository->getDateCreated()->format("d/m/Y")
        );
    }


}
