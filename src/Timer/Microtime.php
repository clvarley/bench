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
     * @var float|null $t_start
     */
    private $t_start;

    public function start() : void
    {
        $this->t_start = microtime( true );
    }

    public function stop() : Duration
    {
        $end = microtime( true );

        if ( !isset( $this->t_start ) ) {
            throw new LogicException(
                'Cannot call ::stop() on timer that has not yet started'
            );
        }

        $value = $end - $this->t_start;

        return new Duration( $value, Duration::PRECISION_SECONDS );
    }
}
