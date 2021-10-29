<?php

namespace Clvarley\Bench\Tests\Timer;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\Timer\Microtime;

Class MicrotimeTest Extends TestCase
{
    private $timer;

    protected function setUp() : void
    {
        $this->timer = new Microtime();
    }

    public function testThrowsWhenNotStarted() : void
    {

    }

    public function testThrowsWhenNotFinished() : void
    {

    }

    public function testCalculatesDifferenceBetweenTimes() : void
    {

    }
}
