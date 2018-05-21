<?php

namespace ADelf\SharedMemory;

class Reader
{
    protected $sharedMemoryResource;
    protected $writer;

    public function __construct($resource)
    {
        $this->sharedMemoryResource = $resource;
        $this->writer = new Writer($resource);
    }

    public function read()
    {
        return shmop_read(
            $this->sharedMemoryResource,
            ControlMarkings::CURRENT_OFFSET_FILE_OFFSET + 1,
            $this->writer->getLastWrittenPosition()
        );
    }
}
