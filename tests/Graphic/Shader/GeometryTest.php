<?php

namespace Graphic\Shader;

use Mammoth\Graphic\Shader\Geometry;
use PHPUnit\Framework\TestCase;

class GeometryTest extends TestCase
{
    public function testShaderTypeIsSet() {
        $shader = new Geometry('', true);
        $this->assertEquals('Code(type=geometry, id=0)', (string)$shader);
    }
}
