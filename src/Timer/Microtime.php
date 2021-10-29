<?php

namespace Clvarley\Bench\Timer;

use Clvarley\Bench\TimerInterface;
use LogicException;
use Clvarley\Bench\Duration;

use function microtime;

/**
 * Timer that uses PHPs `microtime` function to calculate duration
 */
Class Microtime Implements TimerInterface
{

    /**
     * @var float $t_start
     */
    private $t_start;

    /**
     * @var float $t_end
     */
    private $t_end;

    public function start() : void
    {
        $this->t_start = microtime( true );
    }

    public function stop() : void
    {
        $end = microtime( true );

        if ( !isset( $this->t_start ) ) {
            throw new LogicException(
                'Cannot call ::stop() on timer that has not yet started'
            );
        }

        $this->t_end = $end;
    }

    public function result() : Duration
    {
        if ( !isset( $this->t_end ) ) {
            throw new LogicException(
                'Cannot call ::result() on a timer without first stopping it'
            );
        }

        $value = $this->t_end - $this->t_start;

        return new Duration( $value, Duration::PRECISION_SECONDS );
    }
}
