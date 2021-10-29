<?php

namespace Clvarley\Bench\Tests;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\Duration;

Class DurationTest Extends TestCase
{
    public function precisionProvider() : array
    {
        return [
            'seconds' => [ Duration::PRECISION_SECONDS ],
            'milliseconds' => [ Duration::PRECISION_MILLISECONDS ],
            'microseconds' => [ Duration::PRECISION_MICROSECONDS ]
        ];
    }

    /** @dataProvider precisionProvider */
    public function testCanGetDurationPrecision( int $precision ) : void
    {
        $duration = new Duration( 0, $precision );

        self::assertSame( $precision, $duration->getPrecision() );
    }

    public function testCanCreateDurationAsSeconds() : void
    {
        $duration = new Duration( 0.45, Duration::PRECISION_SECONDS );

        self::assertSame( 0.45,     $duration->getSeconds() );
        self::assertSame( 450.0,    $duration->getMilliseconds() );
        self::assertSame( 450000.0, $duration->getMicroseconds() );
    }

    public function testCanCreateDurationAsMilliseconds() : void
    {
        $duration = new Duration( 450, Duration::PRECISION_MILLISECONDS );

        self::assertSame( 0.45,     $duration->getSeconds() );
        self::assertSame( 450.0,    $duration->getMilliseconds() );
        self::assertSame( 450000.0, $duration->getMicroseconds() );
    }

    public function testCanCreateDurationAsMicroseconds() : void
    {
        $duration = new Duration( 450000, Duration::PRECISION_MICROSECONDS );

        self::assertSame( 0.45,     $duration->getSeconds() );
        self::assertSame( 450.0,    $duration->getMilliseconds() );
        self::assertSame( 450000.0, $duration->getMicroseconds() );
    }

    public function testCanAddTwoDurationsOfSamePrecision() : void
    {
        $val1 = new Duration( 0.75,  Duration::PRECISION_SECONDS );
        $val2 = new Duration( 0.125, Duration::PRECISION_SECONDS );

        $result = Duration::add( $val1, $val2 );

        // Should not drop precision
        self::assertSame( Duration::PRECISION_SECONDS, $result->getPrecision() );
        self::assertSame( 0.875, $result->getSeconds() );
    }

    public function testCanAddTwoDurationsOfDifferingPrecision() : void
    {
        $val1 = new Duration( 0.075, Duration::PRECISION_SECONDS );
        $val2 = new Duration( 12500, Duration::PRECISION_MICROSECONDS );

        $result = Duration::add( $val1, $val2 );

        // Drop to most accurate
        self::assertSame( Duration::PRECISION_MICROSECONDS, $result->getPrecision() );
        self::assertSame( 0.0875, $result->getSeconds() );
    }
}
