<?php

namespace Clvarley\Bench\Timer;

use Clvarley\Bench\TimerInterface;
use LogicException;

use function microtime;

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

    public function end() : void
    {
        $end = microtime( true );

        if ( !isset( $this->t_start ) ) {
            throw new LogicException(
                'Cannot call ::end() on timer that has not yet started'
            );
        }

        $this->t_end = $end;
    }

    public function result() : void
    {
        if ( !isset( $this->t_end ) ) {
            throw new LogicException(
                'Cannot call ::result() before a timer has finished'
            );
        }

        // TODO:
    }
}
