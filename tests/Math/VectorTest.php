<?php

declare(strict_types=1);

namespace Mammoth\Math;

class VectorTest extends \PHPUnit\Framework\TestCase
{

    public function testDefaultConstructorInitializesComponents()
    {
        $vec3 = new Vector();
        $this->assertEquals(0, $vec3->x);
        $this->assertEquals(0, $vec3->y);
        $this->assertEquals(0, $vec3->z);
    }

    public function testConstructorValues()
    {
        $vec = new Vector(5, 10);
        $this->assertEquals(5, $vec->x);
        $this->assertEquals(10, $vec->y);
    }

    public function testStringRepresentation()
    {
        $vector = new Vector(-5, 2, 3);
        $this->assertEquals('Vector(-5, 2, 3)', strval($vector));
    }

    public function testArrayConversion()
    {
        $vector = new Vector(7, 14, 21);
        $this->assertEquals(array(7, 14, 21), $vector->toArray());
    }

    public function testComponentsCanBeAccessedByIndexes()
    {
        $vec3 = new Vector(10, 20, 30);
        $this->assertEquals(30, $vec3[2]);
        $this->assertEquals(20, $vec3[1]);
        $this->assertEquals(10, $vec3[0]);
    }

    public function testNegateModifiesAllComponents()
    {
        $vec3 = new Vector(5, 15, -30);
        $negatedVec = $vec3->negate();
        $this->assertEquals(-5, $negatedVec->x);
        $this->assertEquals(-15, $negatedVec->y);
        $this->assertEquals(30, $negatedVec->z);

        // The original vector remains intact.
        $this->assertEquals(5, $vec3->x);
        $this->assertEquals(15, $vec3->y);
        $this->assertEquals(-30, $vec3->z);
    }

    public function testScalarMultiplication()
    {
        $vec3 = new Vector(2, 4, 6);
        $scaledVector = $vec3->scale(3);
        $this->assertEquals(6, $scaledVector->x);
        $this->assertEquals(12, $scaledVector->y);
        $this->assertEquals(18, $scaledVector->z);
    }

    public function testAddition()
    {
        $firstVector = new Vector(2, 4, 6);
        $secondVector = new Vector(1, 2, 3);
        $addedVector = $firstVector->add($secondVector);
        $this->assertEquals(3, $addedVector->x);
        $this->assertEquals(6, $addedVector->y);
        $this->assertEquals(9, $addedVector->z);
    }

    public function testSubstraction()
    {
        $firstVector = new Vector(2, 4, 6);
        $secondVector = new Vector(1, 2, 3);
        $addedVector = $firstVector->substract($secondVector);
        $this->assertEquals(1, $addedVector->x);
        $this->assertEquals(2, $addedVector->y);
        $this->assertEquals(3, $addedVector->z);
    }

    /**
     * @return array
     */
    public function vectorLengths()
    {
        return array(
            array(new Vector(0, 0, 0), 0),
            array(new Vector(1, 1, 1), 1.7320508075689),
        );
    }

    /**
     * @dataProvider vectorLengths
     */
    public function testLength(Vector $vector, $expectedLength)
    {
        $this->assertEquals($expectedLength, $vector->length());
    }
}
