<?php

namespace Clvarley\Bench;

/**
 * Stores information about how long a test took to run
 *
 * @internal
 */
Class Duration
{

    /**
     * @var int $seconds
     */
    public $seconds = 0;

    /**
     * @var int $milliseconds
     */
    public $milliseconds = 0;

    /**
     * @var int $microseconds
     */
    public $microseconds = 0;

}
