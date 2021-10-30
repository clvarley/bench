<?php

namespace Clvarley\Bench;

use Clvarley\Bench\TestItem;
use Clvarley\Bench\TimerInterface;
use Clvarley\Bench\ResultSet;

/**
 * Handles benchmarking a single test
 */
Class Benchmark
{

    /**
     * @var TestItem $test
     */
    private $test;

    /**
     * @var TimerInterface $timer
     */
    private $timer;

    /**
     * @psalm-var positive-int
     * @var int $iterations
     */
    private $_iterations = 1;

    /**
     * Construct a new benchmark for the given test
     *
     * @param TestItem $test        Test function
     * @param TimerInterface $timer Timing method
     */
    public function __construct( TestItem $test, TimerInterface $timer )
    {
        $this->test = $test;
        $this->timer = $timer;
    }

    /**
     * Sets the number of iterations for this test
     *
     * @psalm-param positive-int $iterations
     * @return self Chainable interface
     */
    public function iterations( int $iterations ) : self
    {
        $this->_iterations = $iterations;

        return $this;
    }

    /**
     * Execute the test and return performance results
     */
    public function run() : ResultSet
    {
        $results = [];
        $callback = $this->test->getTest();

        for ( $i = 0; $i < $this->_iterations; $i++ ) {
            $this->timer->start();
                $callback();
            $this->timer->stop();
            $results[] = $this->timer->result();
        }

        return new ResultSet( $this->test, $results );
    }
}
