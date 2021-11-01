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
     * Stops the timer and return duration
     *
     * @throws LogicException Thrown if the timer hasn't started
     * @return Duration Timer duration
     */
    public function stop() : Duration;

}
