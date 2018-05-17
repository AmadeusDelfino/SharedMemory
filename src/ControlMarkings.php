<?php

namespace ADelf\SharedMemory;

class ControlMarkings
{
    CONST LOCKED_FILE_INDICATOR_START = 0;
    CONST LOCKED_FILE_INDICATOR_OFFSET = 0;
    CONST LOCKED_FILE_INDICATOR_TRUE = 1;
    CONST LOCKED_FILE_INDICATOR_FALSE = 0;

    CONST CURRENT_OFFSET_FILE_START = 1;
    CONST CURRENT_OFFSET_FILE_OFFSET = 20;

    /*
     * It is possible to use as offset maximum value the number 99999999999999999999
     * Example locked memory (position=value)
     * - Locked memory
     * - Offset to write is 10
     * |-------------------------------------------------------------------------|
     * | 1=1;2=1;3=0;4=;5...20=                                                  |
     * |-------------------------------------------------------------------------|
     *
     * Example unlocked memory (position=value)
     * - Locked memory
     * - Offset to write is 257
     * |-------------------------------------------------------------------------|
     * | 1=0;2=2;3=5;4=7;5=...20=                                                |
     * |-------------------------------------------------------------------------|
     *
     */
}