<?php

declare(strict_types=1);

namespace Mammoth\Math;

class Matrix implements \ArrayAccess
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data = null)
    {
        if ($data == null) {
            $data = [
                [1.0, 0.0, 0.0, 0.0],
                [0.0, 1.0, 0.0, 0.0],
                [0.0, 0.0, 1.0, 0.0],
                [0.0, 0.0, 0.0, 1.0],
            ];
        }
        $this->data = $data;
    }

    public function multiply(Matrix $other): Matrix
    {
        $result = [
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0],
        ];
        $otherArray = $other->toArray();

        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                for ($k = 0; $k < 4; $k++) {
                    $result[$i][$j] += $this->data[$i][$k] * $otherArray[$k][$j];
                }
            }
        }

        return new Matrix($result);
    }

    public function scale(float $value): Matrix
    {
        if ($value instanceof Vector || is_numeric($value)) {
            return new Matrix([
                [$this->data[0][0] * $value, $this->data[0][1] * $value, $this->data[0][2] * $value, $this->data[0][3] * $value],
                [$this->data[1][0] * $value, $this->data[1][1] * $value, $this->data[1][2] * $value, $this->data[1][3] * $value],
                [$this->data[2][0] * $value, $this->data[2][1] * $value, $this->data[2][2] * $value, $this->data[2][3] * $value],
                [$this->data[3][0], $this->data[3][1], $this->data[3][2], $this->data[3][3]]
            ]);
        } else {
            return new Matrix([
                [$this->data[0][0] * $value, $this->data[0][1] * $value, $this->data[0][2] * $value, $this->data[0][3] * $value],
                [$this->data[1][0] * $value, $this->data[1][1] * $value, $this->data[1][2] * $value, $this->data[1][3] * $value],
                [$this->data[2][0] * $value, $this->data[2][1] * $value, $this->data[2][2] * $value, $this->data[2][3] * $value],
                [$this->data[3][0] * $value, $this->data[3][1] * $value, $this->data[3][2] * $value, $this->data[3][3] * $value]
            ]);
        }
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function __toString(): string
    {
        return sprintf(
            'mat4x4((%f, %f, %f, %f), (%f, %f, %f, %f), (%f, %f, %f, %f), (%f, %f, %f, %f))',
            $this->data[0][0],
            $this->data[0][1],
            $this->data[0][2],
            $this->data[0][3],
            $this->data[1][0],
            $this->data[1][1],
            $this->data[1][2],
            $this->data[1][3],
            $this->data[2][0],
            $this->data[2][1],
            $this->data[2][2],
            $this->data[2][3],
            $this->data[3][0],
            $this->data[3][1],
            $this->data[3][2],
            $this->data[3][3]
        );
    }
    
    public function offsetExists(mixed $offset): bool
    {
        return ($offset >= 0 && $offset <= 3);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
    }

    public function offsetUnset(mixed $offset): void
    {
    }

    public function toRowVector(): array
    {
        return array_merge([], ...$this->data);
    }
}
