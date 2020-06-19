<?php

declare(strict_types=1);

namespace Mammoth\Math;

class Transform
{

    public static function lookAt(Vector $eye, Vector $center, Vector $up): Matrix
    {
        $cameraDirection = $eye->substract($center)->normalize();
        $cameraRight = $up->cross($cameraDirection)->normalize();
        $cameraUp = $cameraDirection->cross($cameraRight); //->normalize();
        $orientation = new Matrix([
            [$cameraRight->x, $cameraUp->x, $cameraDirection->x, 0],
            [$cameraRight->y, $cameraUp->y, $cameraDirection->y, 0],
            [$cameraRight->z, $cameraUp->z, $cameraDirection->z, 0],
            [0, 0, 0, 1.0],
        ]);
        $translation = new Matrix([
            [1, 0, 0, 0],
            [0, 1, 0, 0],
            [0, 0, 1, 0],
            [-$cameraRight->dot($eye), -$cameraUp->dot($eye), -$cameraDirection->dot($eye), 1],
        ]);
        return $orientation->multiply($translation);
    }

    public static function perspective(float $fovy, float $aspect, float $zNear, float $zFar): Matrix
    {
        $fovy = deg2rad($fovy);
        $f = 1 / tan($fovy / 2);

        $result = new Matrix([
            [$f / $aspect, 0, 0, 0,],
            [0, $f, 0, 0],
            [0, 0, ($zFar + $zNear) / ($zNear - $zFar), -1],
            [0, 0, (-2 * $zFar * $zNear) / ($zFar - $zNear), 0]
        ]);
        return $result;
    }

    public static function rotate(Matrix $m, $angle, Vector $normal): Matrix
    {
        $angle = deg2rad($angle);
        if ($normal->x) {
            $rotation = new Matrix([
                [1.0, 0.0, 0.0, 0.0],
                [0, cos($angle), -sin($angle), 0],
                [0, sin($angle), cos($angle),  0],
                [0.0, 0.0, 0.0, 1.0]
            ]);
            $rotation = $rotation->multiply($m);
        }
        if ($normal->y) {
            $rotation = new Matrix([
                [cos($angle), 0, sin($angle), 0],
                [0.0, 1.0, 0.0, 0.0],
                [-sin($angle), 0, cos($angle), 0],
                [0.0, 0.0, 0.0, 1.0]
            ]);
            $rotation = $rotation->multiply($m);
        }
        if ($normal->z) {
            $rotation = new Matrix([
                [cos($angle), -sin($angle), 0.0, 0],
                [sin($angle), cos($angle), 0.0, 0],
                [0.0, 0.0, 1.0, 0.0],
                [0.0, 0.0, 0.0, 1.0]
            ]);
            $rotation  = $rotation->multiply($m);
        }
        return $rotation;
    }

    public static function translate(Matrix $m, Vector $v): Matrix
    {
        $translation = new Matrix([
            [1.0, 0.0, 0.0, 0],
            [0.0, 1.0, 0.0, 0],
            [0.0, 0.0, 1.0, 0],
            [$v->x, $v->y, $v->z, 1.0]
        ]);

        return $translation->multiply($m);
    }
}
