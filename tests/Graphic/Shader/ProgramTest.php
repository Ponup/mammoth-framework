<?php

declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class ProgramTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @requires extension opengl
     */
    public function testProgramIdIsInteger()
    {
        $program = new Program;
        $this->assertIsInt($program->getId());
    }

    /**
     * @requires extension opengl
     */
    public function testNewProgramHasNoShaders()
    {
        $program = new Program;
        $this->assertCount(0, $program->getShaders());
    }
}
