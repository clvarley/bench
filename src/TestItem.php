<?php

namespace Clvarley\Bench;

/**
 * Represents a single repeatable test
 *
 * @psalm-immutable
 */
Class TestItem
{

    /**
     * Display friendly name for this test
     *
     * @psalm-var non-empty-string $name
     *
     * @var string $name
     */
    private $name;

    /**
     * Callable/closure provided by user
     *
     * @var callable $test
     */
    private $test;

    /**
     * Create a new named benchmark test
     *
     * @psalm-param non-empty-string $name
     *
     * @param string $name   Test name
     * @param callable $test User function
     */
    public function __construct( string $name, callable $test )
    {
        $this->name = $name;
        $this->test = $test;
    }

    /**
     * Returns the name of this test
     *
     * @psalm-return non-empty-string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the user provided callable
     */
    public function getTest() : callable
    {
        return $this->test;
    }
}
