<?php

namespace Clvarley\Bench;

use Clvarley\Bench\TestItem;
use Clvarley\Bench\Timer\Microtime;
use Clvarley\Bench\ResultSet;
use Clvarley\Bench\Printer\SimpleConsole;

/**
 * Tests the given function and outputs benchmark information
 *
 * @psalm-param non-empty-string $name
 * @param string $name    Test name
 * @param callable $test  Test function
 * @param int $iterations Number of iterations
 */
function bench( string $name, callable $test, int $iterations = 1 ) : void
{
    $timer = new Microtime();
    $results = [];

    for ( $i = 0; $i < $iterations; $i++ ) {
        $timer->start();
        $test();
        $timer->stop();
        $results[] = $timer->result();
    }

    $test = new TestItem( $name, $test );
    $results = new ResultSet( $test, $results );

    (new SimpleConsole())->display( $results );
}
