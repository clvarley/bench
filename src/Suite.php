<?php

namespace Clvarley\Bench;

use Clvarley\Bench\TimerInterface;
use Clvarley\Bench\PrinterInterface;
use Clvarley\Bench\Benchmark;
use Clvarley\Bench\Unit;

/**
 * Represents a suite of benchmark tests
 */
Class Suite
{

    /**
     * @readonly
     *
     * @var TimerInterface $timer
     */
    private $timer;

    /**
     * @readonly
     *
     * @var PrinterInterface $printer
     */
    private $printer;

    /**
     * @var Benchmark[] $tests
     */
    private $tests = [];

    /**
     * Create a test suite with your preferred timing and display methods
     *
     * @psalm-mutation-free
     *
     * @param TimerInterface $timer     Timing method
     * @param PrinterInterface $printer Display method
     */
    public function __construct( TimerInterface $timer, PrinterInterface $printer )
    {
        $this->timer = $timer;
        $this->printer = $printer;
    }

    /**
     * Add a new function to the test suite
     *
     * @psalm-param non-empty-string $name
     * @psalm-param positive-int $iterations
     *
     * @param string $name    Test name
     * @param callable $test  Test function
     * @param int $iterations Number of iterations
     * @return self           Chainable interface
     */
    public function add( string $name, callable $test, int $iterations = 1 ) : self
    {
        $test = new Unit( $name, $test );
        $benchmark = new Benchmark( $test, $this->timer );
        $benchmark->iterations( $iterations );

        $this->tests[] = $benchmark;

        return $this;
    }

    /**
     * Execute this test suite and displays results
     */
    public function run() : void
    {
        foreach ( $this->tests as $test ) {
            $result = $test->run();

            $this->printer->display( $result );
        }

        return;
    }
}
