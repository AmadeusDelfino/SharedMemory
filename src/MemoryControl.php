<?php

namespace ADelf\SharedMemory;


class MemoryControl
{
    protected $sharedMemoryResource;
    /*
     * Default mem size 0,5 megabytes
     */
    protected $defaultMemSize = 500000;
    protected $permissionDefault = 0666;
    protected $resourceLocked = false;
    protected $memorySharedToken;


    public function __construct($resource = null)
    {
        $this->sharedMemoryResource = $resource;
    }

    public function lock()
    {
        shmop_write($this->sharedMemoryResource, 1, 0);
    }

    public function unlock()
    {
        shmop_write($this->sharedMemoryResource, 0, 0);

    }

    public function isLocked( )
    {
        return (boolean) shmop_read(
            $this->sharedMemoryResource,
            ControlMarkings::LOCKED_FILE_INDICATOR_START,
            ControlMarkings::LOCKED_FILE_INDICATOR_OFFSET
        );
    }

    public function size()
    {
        return shmop_size($this->sharedMemoryResource);
    }

    public function close()
    {
        shmop_delete($this->sharedMemoryResource);
        shmop_close($this->sharedMemoryResource);
    }

    /**
     * @throws \Exception
     */
    public function initSharedMemory()
    {
        $this->memorySharedToken = random_int(100000, 999999);

        $this->sharedMemoryResource = \shmop_open(
            $this->memorySharedToken,
            'c',
            $this->permissionDefault,
            $this->defaultMemSize
        );

        return $this;
    }

    public function getSharedMemoryResource()
    {
        return $this->sharedMemoryResource;
    }

}
