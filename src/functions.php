<?php

namespace Clvarley\Bench;

use Clvarley\Bench\TestItem;
use Clvarley\Bench\Timer\Microtime;
use Clvarley\Bench\Benchmark;
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
    $test = new TestItem( $name, $test );
    $timer = new Microtime();

    $results = (new Benchmark( $test, $timer ))
        ->iterations( $iterations )
        ->run();

    (new SimpleConsole())->display( $results );
}
