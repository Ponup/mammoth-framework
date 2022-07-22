<?php declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class Code
{
    private ShaderType $type;
    private int $id;
    private string $source;

    public function __construct(ShaderType $type, string $source, $sourceIsCode = false)
    {
        $this->type = $type;
        $this->source = false === $sourceIsCode ? file_get_contents($source) : $source;

        $this->id = glCreateShader($type->convertToGlType());
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function compile(): void
    {
        glShaderSource($this->id, 1, $this->source, 0);
        glCompileShader($this->id);
    }

    public function __toString(): string
    {
        return sprintf('Code(type=%s, id=%d)', $this->type->value, $this->id);
    }
}
