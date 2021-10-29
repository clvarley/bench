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
     * @throws LogicException Thrown if the timer hasn't started
     */
    public function stop() : void;

    /**
     * Return the result of this timer
     *
     * @throws LogicException Thrown if the timer hasn't stopped
     * @return Duration       Timing information
     */
    public function result() : Duration;

}
