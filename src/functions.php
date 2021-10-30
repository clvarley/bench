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
 * @psalm-param positive-int $iterations
 * @param string $name    Test name
 * @param callable $test  Test function
 * @param int $iterations Number of iterations
 */
function bench( string $name, callable $test, int $iterations = 1 ) : void
{
    $timer = new Microtime();
    $console = new SimpleConsole();

    $suite = new Suite( $timer, $console );
    $suite->add( $name, $test )->iterations( $iterations );
    $suite->run();
}
