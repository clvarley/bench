<?php

namespace Clvarley\Bench\Tests;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\TestItem;

Class TestItemTests Extends TestCase
{
    /** @var TestItem $item */
    private $item;

    protected function setUp() : void
    {
        $this->item = new TestItem( 'example test', 'is_string' );
    }

    public function testCanReturnTestName() : void
    {
        self::assertSame( 'example test', $this->item->getName() );
    }

    public function testCanReturnTestFunction() : void
    {
        self::assertSame( 'is_string', $this->item->getTest() );
    }
}
