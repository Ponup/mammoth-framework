<?php declare(strict_types=1);

namespace Mammoth\Math;

class Angle
{

    static public function toRadians(float $degrees): float
    {
        return deg2rad($degrees);
    }
}
