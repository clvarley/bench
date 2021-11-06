<?php

namespace Clvarley\Bench\Tests;

use PHPUnit\Framework\TestCase;
use Clvarley\Bench\Suite;

use function Clvarley\Bench\tests;
use function Clvarley\Bench\bench;

Class FunctionTest Extends TestCase
{
    private function getRegex( string $name, int $iterations ) : string
    {
        $start = <<<REGEX
        Results for test: $name
        ---
        Iterations:
        REGEX;

        $middle = <<<REGEX
        (?\- \d+ took: [0-9\.]+ ms){{$iterations}}
        REGEX;

        $end = <<<REGEX
        Total time:\s+[0-9\.]+ ms
        Average time:\s+[0-9\.]+ ms
        REGEX;

        var_dump( $start, $middle, $end );
        die;

        return "/^$start\n$middle\n$end/";
    }

    public function testCanCreateTestSuite() : void
    {
        $suite = tests();

        self::assertInstanceOf( Suite::class, $suite );
    }

    /** @depends testCanCreateTestSuite */
    public function testCanRunSingleBenchmark() : void
    {
        self::expectOutputRegex(
            $this->getRegex( 'single', 1 )
        );

        bench( 'single', function () {} );
    }

    /** @depends testCanCreateTestSuite */
    public function testCanRunMultipleBenchmarks() : void
    {
        self::expectOutputRegex(
            $this->getRegex( 'multiple', 3 )
        );

        bench( 'multiple', function () {}, 3 );
    }
}
