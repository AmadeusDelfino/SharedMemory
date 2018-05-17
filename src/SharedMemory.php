<?php

namespace ADelf\SharedMemory;

class SharedMemory
{
    /** @var Writer */
    protected $writer;
    /** @var Reader */
    protected $reader;
    /** @var MemoryControl */
    protected $memoryControl;

    /**
     * @return SharedMemory
     * @throws \Exception
     */
    public static function init()
    {
        $instance = new self;

        $instance->memoryControl = new MemoryControl();
        $instance->memoryControl->initSharedMemory();
        $resource = $instance->getMemorySharedResource();
        $instance->writer = new Writer($resource);
        $instance->reader = new Reader($resource);

        return $instance;
    }

    public static function attach($memorySharedResource)
    {
        $instance = new self;
        $instance->writer = new Writer($memorySharedResource);
        $instance->reader = new Reader($memorySharedResource);
        $instance->memoryControl = new MemoryControl($memorySharedResource);

        return $instance;
    }


    public function write($value)
    {
        $this->writer->write($value);

        return $this;
    }

    public function read()
    {
        return $this->reader->read();
    }

    public function getMemorySharedResource()
    {
        return $this->memoryControl->getSharedMemoryResource();
    }

    public function close()
    {
        $this->memoryControl->close();
    }
}
