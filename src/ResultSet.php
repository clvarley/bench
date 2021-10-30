<?php

namespace Clvarley\Bench;

use Clvarley\Bench\TestItem;
use Clvarley\Bench\Duration;

use function count;

/**
 * Stores the results for a single benchmark test
 *
 * @psalm-immutable
 */
Class ResultSet
{

    /**
     * @var TestItem $test
     */
    private $test;

    /**
     * @var Duration[] $results
     */
    private $results;

    /**
     * Create a new result set for the given test
     *
     * @param TestItem $test      Test information
     * @param Duration[] $results Test durations
     */
    public function __construct( TestItem $test, array $results )
    {
        $this->test = $test;
        $this->results = $results;
    }

    /**
     * Returns the test for which these results are relevant
     */
    public function getTest() : TestItem
    {
        return $this->test;
    }

    /**
     * Calculates the total duration taken by all iterations
     */
    public function totalDuration() : Duration
    {
        // Empty duration to use as cumulative total
        $total = new Duration( 0, Duration::PRECISION_SECONDS );

        foreach ( $this->results as $result ) {
            $total = Duration::add( $total, $result );
        }

        return $total;
    }

    /**
     * Calculates the average duration taken by an iteration
     */
    public function averageDuration() : Duration
    {
        $total = $this->totalDuration();

        $value = $total->getValue();
        $precision = $total->getPrecision();

        return new Duration( $value / count( $this->results ), $precision );
    }
}
