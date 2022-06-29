<?php
namespace ManageStudent;

use ManageStudent\Service\Command\CommandBanner;
use Symfony\Component\Console\Application;

class App extends Application
{
    public function __construct()
    {
        parent::__construct("Manage Student CLI", "0.3.1@alpha");

        $this->add(new \ManageStudent\Command\DefaultCommand());
        $this->add(new \ManageStudent\Command\CreateStudentCommand());
        $this->add(new \ManageStudent\Command\CreateFileDefaultCommand());

        CommandBanner::setVersion($this->getVersion());

        $this->setDefaultCommand('default');
    }
}

