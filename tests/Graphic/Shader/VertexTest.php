<?php

namespace Graphic\Shader;

use Mammoth\Graphic\Shader\Vertex;
use PHPUnit\Framework\TestCase;

class VertexTest extends TestCase
{
    public function testShaderTypeIsSet() {
        $shader = new Vertex('', true);
        $this->assertEquals('Code(type=vertex, id=0)', (string)$shader);
    }
}
