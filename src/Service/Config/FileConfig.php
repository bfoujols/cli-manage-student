<?php

namespace Studoo\Service\Config;

class FileConfig
{
    private string $fileName = "studoo";
    private string $extConfig = ".json";
    private string $extStudend = "-db.json";
    private string $extLock = ".lock";
    protected string $fileLock;
    protected string $fileConfig;
    protected string $fileStudend;
    protected string $formatDateTime = 'Y-m-d H:i:s';

    public function __construct()
    {
        $this->fileLock = $this->fileName . $this->extLock;
        $this->fileConfig = $this->fileName . $this->extConfig;
        $this->fileStudend = $this->fileName . $this->extStudend;
    }

}
