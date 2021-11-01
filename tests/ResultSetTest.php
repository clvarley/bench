<?php

namespace Clvarley\Bench\Tests;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\Unit;
use Clvarley\Bench\ResultSet;
use Clvarley\Bench\Duration;

Class ResultSetTest Extends TestCase
{
    public function testCanGetTestInstance() : void
    {
        $mock = $this->createMock( Unit::class );

        $result = new ResultSet( $mock, [] );
        $test = $result->getTest();

        self::assertInstanceOf( Unit::class, $test );
        self::assertSame( $mock, $test );
    }
}
