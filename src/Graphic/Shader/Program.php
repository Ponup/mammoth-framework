<?php

declare(strict_types=1);

namespace Mammoth\Graphic\Shader;

class Program
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $shaders;

    public function __construct()
    {
        $this->id = glCreateProgram();
        $this->shaders = [];
    }

    public function __destruct()
    {
        glDeleteProgram($this->id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function add(Code $code)
    {
        $this->shaders[] = $code;
    }

    public function getShaders(): array
    {
        return $this->shaders;
    }

    public function compile()
    {
        foreach ($this->shaders as $shader) {
            $shader->compile();
        }
    }

    public function link()
    {
        foreach ($this->shaders as $shader) {
            glAttachShader($this->id, $shader->getId());
        }
        glLinkProgram($this->id);
    }

    /**
     * @throws Exception
     */
    public function use()
    {
        glUseProgram($this->id);
    }
}
