<?php

declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class Vertex extends Code
{

    public function __construct($source, $sourceIsCode = false)
    {
        parent::__construct(ShaderType::Vertex, $source, $sourceIsCode);
    }
}
