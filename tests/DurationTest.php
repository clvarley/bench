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

        self::assertSame( 0.45,   $duration->getSeconds() );
        self::assertSame( 450,    $duration->getMilliseconds() );
        self::assertSame( 450000, $duration->getMicroseconds() );
    }

    public function testCanCreateDurationAsMilliseconds() : void
    {
        $duration = new Duration( 450, Duration::PRECISION_MILLISECONDS );

        self::assertSame( 0.45,   $duration->getSeconds() );
        self::assertSame( 450,    $duration->getMilliseconds() );
        self::assertSame( 450000, $duration->getMicroseconds() );
    }

    public function testCanCreateDurationAsMicroseconds() : void
    {
        $duration = new Duration( 450000, Duration::PRECISION_MICROSECONDS );

        self::assertSame( 0.45,   $duration->getSeconds() );
        self::assertSame( 450,    $duration->getMilliseconds() );
        self::assertSame( 450000, $duration->getMicroseconds() );
    }
}
