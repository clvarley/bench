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

        $this->timer->end();
    }

    public function testThrowsWhenNotFinished() : void
    {
        self::expectException( LogicException::class );

        $this->timer->result();
    }

    public function testCalculatesDifferenceBetweenTimes() : void
    {
        $this->timer->start();
        $this->timer->stop();

        $duration = $this->timer->result();

        self::assertInstanceOf( Duration::class, $duration );
        self::assertSame(
            Duration::PRECISION_SECONDS,
            $duration->getPrecision()
        );
    }
}
