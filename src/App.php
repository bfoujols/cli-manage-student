<?php
namespace ManageStudent;

use Symfony\Component\Console\Application;

class App extends Application
{
    public function __construct()
    {
        parent::__construct("Manage Student CLI", "0.1.0@alpha");

        $this->add(new \ManageStudent\Command\DefaultCommand());
        $this->add(new \ManageStudent\Command\CreateStudentCommand());


        $this->setDefaultCommand('default');
    }
}

