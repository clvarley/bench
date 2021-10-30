<?php

namespace Clvarley\Bench;

use Clvarley\Bench\ResultSet;

/**
 * Functionality to display tests results
 */
Interface PrinterInterface
{

    /**
     * Display the results of a single test
     *
     * @param ResultSet $results Test results
     */
    public function display( ResultSet $results ) : void;

}
