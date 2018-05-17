<?php

namespace ADelf\SharedMemory;


class Writer
{
    protected $sharedMemoryResource;

    public function __construct($resource)
    {
        $this->sharedMemoryResource = $resource;
        $this->writeDefaultValuesInMemory();
    }

    public function write($value)
    {
        $this->incrementWriteOffset(shmop_write($this->sharedMemoryResource, $value, $this->getOffsetToWrite()));

        return $this;
    }

    public function getLastWrittenPosition()
    {
        return (int) shmop_read(
            $this->sharedMemoryResource,
            ControlMarkings::CURRENT_OFFSET_FILE_START,
            ControlMarkings::CURRENT_OFFSET_FILE_OFFSET
        );
    }

    private function getOffsetToWrite()
    {
        return $this->getLastWrittenPosition() + 1;
    }

    private function incrementWriteOffset($number)
    {
        $current = $this->getLastWrittenPosition();
        $current += $number;
        shmop_write($this->sharedMemoryResource, $current, ControlMarkings::CURRENT_OFFSET_FILE_START);
    }

    private function writeDefaultValuesInMemory()
    {
        shmop_write($this->sharedMemoryResource, ControlMarkings::LOCKED_FILE_INDICATOR_FALSE, ControlMarkings::LOCKED_FILE_INDICATOR_START);
        shmop_write($this->sharedMemoryResource, ControlMarkings::CURRENT_OFFSET_FILE_OFFSET+1, ControlMarkings::CURRENT_OFFSET_FILE_START);
    }

}