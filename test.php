<?php

use ADelf\SharedMemory\SharedMemory;
require 'vendor/autoload.php';
require 'src/SharedMemory.php';

$sm = SharedMemory::init();
$sm->write('teste');
$sm->write('test2');
$sm->write('test3');
$sm2 = SharedMemory::attach($sm->getMemorySharedResource());
var_dump($sm2->read());
$sm->close();