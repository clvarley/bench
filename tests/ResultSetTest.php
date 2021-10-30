<?php

namespace Clvarley\Bench\Tests;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\TestItem;
use Clvarley\Bench\ResultSet;
use Clvarley\Bench\Duration;

Class ResultSetTest Extends TestCase
{
    public function testCanGetTestInstance() : void
    {
        $mock = $this->createMock( TestItem::class );

        $result = new ResultSet( $mock, [] );
        $test = $result->getTest();

        self::assertInstanceOf( TestItem::class, $test );
        self::assertSame( $mock, $test );
    }
}
