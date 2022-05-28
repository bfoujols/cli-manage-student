<?php
namespace ManageStudent;

use Symfony\Component\Console\Application;

class App extends Application
{
    public function __construct()
    {
        parent::__construct("Manage-Student", "@dev");

        $this->add(new \ManageStudent\Command\CreateStudentCommand());

        $this->setDefaultCommand('student:create');
    }
}