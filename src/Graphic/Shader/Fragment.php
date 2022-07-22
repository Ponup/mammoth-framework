<?php

declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class Fragment extends Code
{

    public function __construct($source, $sourceIsCode = false)
    {
        parent::__construct(ShaderType::Fragment, $source, $sourceIsCode);
    }
}
