<?php

namespace Clvarley\Bench\Tests;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\TestItem;
use Clvarley\Bench\Result;
use Clvarley\Bench\Duration;

Class ResultTest Extends TestCase
{
    public function testCanGetTestInstance() : void
    {
        $mock = $this->createMock( TestItem::class );

        $result = new Result( $mock, [] );
        $test = $result->getTest();

        self::assertInstanceOf( TestItem::class, $test );
        self::assertSame( $mock, $test );
    }
}
