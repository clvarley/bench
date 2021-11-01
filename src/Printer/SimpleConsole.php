<?php

namespace Clvarley\Bench\Printer;

use Clvarley\Bench\PrinterInterface;
use Clvarley\Bench\ResultSet;

use function floor;
use function log10;
use function vsprintf;

use const PHP_EOL;

/**
 * Prints simplified test results to the console
 */
Class SimpleConsole Implements PrinterInterface
{

    public function display( ResultSet $results ) : void
    {
        $name = $results->getTest()->getName();
        $count = $results->count();

        $this->print( "Results for test: $name" );
        $this->print( '---' );
        $this->print( 'Iterations:' );

        // How many digits in this number?
        $digits = floor( log10( $count ) ) + 1;

        // Build sprintf format
        $format = "- %0{$digits}d took: %07f ms";

        foreach ( $results->getResults() as $i => $result ) {
            $this->print( $format, $i, $result->getMilliseconds() );
        }

        $this->print( '---' );

        // Totals
        $this->print( 'Total time:   %07f ms',
            $results->totalDuration()->getMilliseconds()
        );
        $this->print( 'Average time: %07f ms',
            $results->averageDuration()->getMilliseconds()
        );

        return;
    }

    /**
     * Print a formatted line to the console
     *
     * @psalm-param non-empty-string $format
     * @psalm-param list<scalar> $args
     */
    private function print( string $format, ...$args ) : void
    {
        echo vsprintf( $format, $args ), PHP_EOL;
    }
}
