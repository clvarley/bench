<?php

namespace Clvarley\Bench;

/**
 * Stores information about how long a test took to run
 *
 * @psalm-immutable
 * @internal
 */
Class Duration
{

    const PRECISION_SECONDS = 1000 ^ 0;
    const PRECISION_MILLISECONDS = 1000 ^ 1;
    const PRECISION_MICROSECONDS = 1000 ^ 2;

    /**
     * @var float $value
     */
    private $value;

    /**
     * @psalm-var self::PRECISION_* $precision
     * @var int $precision
     */
    private $precision;

    /**
     * Create a new duration value using
     *
     * @psalm-param self::PRECISION_* $precision
     * @param float $value   Duration length
     * @param int $precision Value precision
     */
    public function __construct( float $value, int $precision = self::PRECISION_MICROSECONDS )
    {
        $this->value = $value;
        $this->precision = $precision;
    }

    /**
     * Returns the precision of this duration
     *
     * @psalm-return self::PRECISION_*
     */
    public function getPrecision() : int
    {
        return $this->precision;
    }

    /**
     * Returns the duration in seconds
     */
    public function getSeconds() : float
    {
        return $this->value * $this->precision;
    }

    /**
     * Returns the duration in milliseconds
     */
    public function getMilliseconds() : float
    {
        return $this->value * $this->multiplier( self::PRECISION_MILLISECONDS );
    }

    /**
     * Returns the duration in microseconds
     */
    public function getMicroseconds() : float
    {
        return $this->value * $this->multiplier( self::PRECISION_MICROSECONDS );
    }

    /**
     * Get the multiplier required to convert to a given precision
     *
     * @psalm-param self::PRECISION_* $target
     * @param int $target Target precision
     */
    public function multiplier( int $target ) : int
    {
        return $target / $this->precision;
    }
}
