<?php

declare(strict_types=1);

namespace Mammoth\Math;

class MatrixTest extends \PHPUnit\Framework\TestCase
{

    public function testConstructorDefaultsToIdentityMatrix()
    {
        $matrix = new Matrix;
        $expectedArray = array(
            array(1, 0, 0, 0),
            array(0, 1, 0, 0),
            array(0, 0, 1, 0),
            array(0, 0, 0, 1),
        );
        $this->assertEquals($expectedArray, $matrix->toArray());
    }

    public function testStringFormat()
    {
        $matrix = new Matrix;
        $this->assertEquals('mat4x4((1.000000, 0.000000, 0.000000, 0.000000), (0.000000, 1.000000, 0.000000, 0.000000), (0.000000, 0.000000, 1.000000, 0.000000), (0.000000, 0.000000, 0.000000, 1.000000))', strval($matrix));
    }
}
