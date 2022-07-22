<?php

namespace Graphic\Shader;

use Mammoth\Graphic\Shader\ShaderType;
use PHPUnit\Framework\TestCase;

class ShaderTypeTest extends TestCase
{
    public function testConvertType(): void {
        $this->assertEquals(GL_GEOMETRY_SHADER, ShaderType::Geometry->convertToGlType());
    }
}
