<?php
namespace Studoo;

use Studoo\Service\Command\CommandBanner;
use Symfony\Component\Console\Application;

class App extends Application
{
    public function __construct()
    {
        parent::__construct("Studoo", "0.6.0@alpha");

        $this->add(new \Studoo\Command\DefaultCommand());
        $this->add(new \Studoo\Command\CreateStudentCommand());
        $this->add(new \Studoo\Command\CreateFileDefaultCommand());

        CommandBanner::setVersion($this->getVersion());

        $this->setDefaultCommand('default');
    }
}

