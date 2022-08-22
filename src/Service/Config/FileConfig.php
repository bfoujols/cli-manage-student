<?php

namespace Studoo\Service\Config;

class FileConfig
{
    private string $fileName = "mstud";
    private string $extConfig = ".json";
    private string $extLock = ".lock";
    protected string $fileLock;
    protected string $formatDateTime = 'Y-m-d H:i:s';

    public function __construct()
    {
        $this->fileLock = $this->fileName . $this->extLock;
    }

}