<?php

namespace Graphic\Shader;

use Mammoth\Graphic\Shader\Fragment;
use PHPUnit\Framework\TestCase;

class FragmentTest extends TestCase
{
    public function testShaderTypeIsSet() {
        $shader = new Fragment('', true);
        $this->assertEquals('Code(type=fragment, id=0)', (string)$shader);
    }
}
