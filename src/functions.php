<?php

namespace Clvarley\Bench;

use Clvarley\Bench\Timer\Microtime;
use Clvarley\Bench\Printer\SimpleConsole;
use Clvarley\Bench\Benchmark;

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
    $suite = tests();
    $suite->add( $name, $test )->iterations( $iterations );
    $suite->run();
}

/**
 * Create a new test suite with sensible defaults
 *
 * @psalm-pure
 * @return Suite Test suite
 */
function tests() : Suite
{
    $timer = new Microtime();
    $console = new SimpleConsole();

    return new Suite( $timer, $console );
}
