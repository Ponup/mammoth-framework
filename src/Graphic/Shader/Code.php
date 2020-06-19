<?php

declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class Code
{

    const VERTEX = 'VERTEX';
    const GEOMETRY = 'GEOMETRY';
    const FRAGMENT = 'FRAGMENT';

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $source;

    public function __construct($type, $source, $sourceIsCode = false)
    {
        $this->type = $type;
        $this->source = false === $sourceIsCode ? file_get_contents($source) : $source;

        $glType = $this->convertToGlType($type);
        $this->id = glCreateShader($glType);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function compile()
    {
        glShaderSource($this->id, 1, $this->source, 0);
        glCompileShader($this->id);
    }

    private function convertToGlType($type): int
    {
        switch ($type) {
            case self::VERTEX:
                return GL_VERTEX_SHADER;
            case self::GEOMETRY:
                return GL_GEOMETRY_SHADER;
            case self::FRAGMENT:
                return GL_FRAGMENT_SHADER;
        }
    }

    public function __toString(): string
    {
        return sprintf('Code(type=%s, id=%d)', $this->type, $this->id);
    }
}
