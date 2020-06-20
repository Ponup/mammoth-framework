<?php

declare(strict_types=1);

namespace Mammoth\Graphic;

class CameraTest extends \PHPUnit\Framework\TestCase
{

    public function testCameraDefaultsAreSet()
    {
        $camera = new Camera;
        $this->assertEquals(45, $camera->zoom);
    }

    public function testViewMatrixValues()
    {
        $expectedView = 'mat4x4((1.000000, 0.000000, -0.000000, 0.000000), (0.000000, 1.000000, 0.000000, 0.000000), (0.000000, 0.000000, 1.000000, 0.000000), (0.000000, 0.000000, 0.000000, 1.000000))';
        $camera = new Camera;
        $this->assertEquals($expectedView, $camera->getViewMatrix()->__toString());
    }
}
