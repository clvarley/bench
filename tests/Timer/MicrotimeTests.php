<?php

namespace Clvarley\Bench\Tests\Timer;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\Timer\Microtime;

Class MicrotimeTests Extends TestCase
{
    /** @var Microtime $timer */
    private $timer;

    protected function setUp() : void
    {
        $this->timer = new Microtime();
    }

    public function testThrowsWhenNotStarted() : void
    {
        $this->timer->end();
    }

    public function testThrowsWhenNotFinished() : void
    {
        $this->timer->result();
    }

    public function testCalculatesDifferenceBetweenTimes() : void
    {
        $this->timer->start();
        $this->timer->end();

        $duration = $this->timer->result();
    }
}
