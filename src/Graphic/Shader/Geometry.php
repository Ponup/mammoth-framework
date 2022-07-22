<?php

declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class Geometry extends Code
{

    public function __construct($source, $sourceIsCode = false)
    {
        parent::__construct(ShaderType::Geometry, $source, $sourceIsCode);
    }
}
