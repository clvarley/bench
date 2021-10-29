<?php

namespace Clvarley\Bench;

use LogicException;
use Clvarley\Bench\Duration;

/**
 * Functionality to measure the time taken between two points
 */
Interface TimerInterface
{

    /**
     * Starts the timer
     */
    public function start() : void;

    /**
     * Stops the timer
     *
     * @throws LogicException Thrown if timer hasn't started
     */
    public function end() : void;

    /**
     * Return the result of this timer
     *
     * @throws LogicException Thrown if timer hasn't finished
     */
    public function result() : Duration;

}
