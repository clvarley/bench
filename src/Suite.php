<?php

namespace Clvarley\Bench;

use Clvarley\Bench\TimerInterface;
use Clvarley\Bench\PrinterInterface;
use Clvarley\Bench\Benchmark;
use Clvarley\Bench\TestItem;

/**
 * Represents a suite of benchmark tests
 */
Class Suite
{

    /**
     * @var TimerInterface $timer
     */
    private $timer;

    /**
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
     * @param string $name   Test name
     * @param callable $test Test function
     * @return Benchmark     Benchmark object
     */
    public function add( string $name, callable $test ) : Benchmark
    {
        $test = new TestItem( $name, $test );
        $benchmark = new Benchmark( $test, $this->timer );

        return $this->tests[] = $benchmark;
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
