<?php

namespace Clvarley\Bench\Tests\Timer;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\Timer\Microtime;
use LogicException;
use Clvarley\Bench\Duration;

Class MicrotimeTest Extends TestCase
{
    /** @var Microtime $timer */
    private $timer;

    protected function setUp() : void
    {
        $this->timer = new Microtime();
    }

    public function testThrowsWhenNotStarted() : void
    {
        self::expectException( LogicException::class );

        $this->timer->stop();
    }

    public function testCalculatesDifferenceBetweenTimes() : void
    {
        $this->timer->start();

        $duration = $this->timer->stop();

        self::assertInstanceOf( Duration::class, $duration );
        self::assertSame(
            Duration::PRECISION_SECONDS,
            $duration->getPrecision()
        );
    }
}
