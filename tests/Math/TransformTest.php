<?php

declare(strict_types=1);

namespace Mammoth\Math;

class TransformTest extends \PHPUnit\Framework\TestCase
{

    public function testLookAt()
    {
        $a = Transform::lookAt(new Vector(1, 1, 1), new Vector(2, 2, 3), new Vector(4, 4, 4));
        $this->assertNotNull($a);
    }
}
