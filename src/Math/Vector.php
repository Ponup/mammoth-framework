<?php

declare(strict_types=1);

namespace Mammoth\Math;

class Vector
{

    public $x, $y, $z;

    public function __construct(float $x = 0, float $y = 0, float $z = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function length(): float
    {
        return sqrt($this->dot($this));
    }

    public function normalize(): Vector
    {
        $length = $this->length();
        if ($length == 0) {
            return $this;
        }
        $this->x = $this->x / $length;
        $this->y = $this->y / $length;
        $this->z = $this->z / $length;
        return $this;
    }

    public function add(Vector $other): Vector
    {
        return new Vector(
            $this->x + $other->x,
            $this->y + $other->y,
            $this->z + $other->z
        );
    }

    public function substract(Vector $other): Vector
    {
        return new Vector(
            $this->x - $other->x,
            $this->y - $other->y,
            $this->z - $other->z
        );
    }

    public function scale(float $number): Vector
    {
        return new Vector(
            $this->x * $number,
            $this->y * $number,
            $this->z * $number
        );
    }

    public function negate(): Vector
    {
        return new Vector(
            -$this->x,
            -$this->y,
            -$this->z
        );
    }

    public function dot(Vector $other): float
    {
        return ($this->x * $other->x + $this->y * $other->y + $this->z * $other->z);
    }

    public function cross(Vector $other): Vector
    {
        return new Vector(
            $this->y * $other->z - $this->z * $other->y,
            $this->z * $other->x - $this->x * $other->z,
            $this->x * $other->y - $this->y * $other->x
        );
    }
}
