<?php declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

enum ShaderType: string
{
    case Vertex = 'vertex';
    case Geometry = 'geometry';
    case Fragment = 'fragment';

    public function convertToGlType(): int
    {
        return match ($this) {
            ShaderType::Vertex => GL_VERTEX_SHADER,
            ShaderType::Geometry => GL_GEOMETRY_SHADER,
            ShaderType::Fragment => GL_FRAGMENT_SHADER,
        };
    }
}
