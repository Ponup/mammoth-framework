<?php

declare(strict_types=1);

namespace Mammoth\Graphic;

class WavefrontObj
{
    public array $vertices;

    public array $verticesIndices;

    public array $textureCoordinates;

    public array $normals;

    public function __construct()
    {
        $this->vertices = [];
        $this->verticesIndices = [];
        $this->textureCoordinates = [];
        $this->normals = [];
    }

    public function getIndicesAsFloatArray(): array
    {
        $result = [];
        foreach ($this->verticesIndices as $vertex) {
            $result[] = $vertex->x;
            $result[] = $vertex->y;
            $result[] = $vertex->z;
        }

        return $result;
    }

    public function getVerticesAsFloatArray(): array
    {
        $ll = $this->vertices;
        $result = [];
        foreach ($this->verticesIndices as $vi) {
            $result[] = $vi->x >= 0 ? $ll[$vi->x - 1] : array_slice($ll, $vi->x - 1, 1)[0];
            $result[] = $vi->y >= 0 ? $ll[$vi->y - 1] : array_slice($ll, $vi->y - 1, 1)[0];
            $result[] = $vi->z >= 0 ? $ll[$vi->z - 1] : array_slice($ll, $vi->z - 1, 1)[0];
        }
        return $result;
    }

    public function getVertices(): array
    {
        return $this->vertices;
    }

    public function getVertexNormals(): array
    {
        return $this->normals;
    }

    public function getVertexFaces(): array
    {
        return $this->verticesIndices;
    }

    public function getTextureCoordinates(): array
    {
        return $this->textureCoordinates;
    }

    public function getIndices(): array
    {
        $ll = $this->vertices;
        $result = [];
        foreach ($this->verticesIndices as $vi) {
            $result[] = $vi->x >= 0 ? $ll[$vi->x - 1] : array_slice($ll, $vi->x - 1, 1)[0];
            $result[] = $vi->y >= 0 ? $ll[$vi->y - 1] : array_slice($ll, $vi->y - 1, 1)[0];
            $result[] = $vi->z >= 0 ? $ll[$vi->z - 1] : array_slice($ll, $vi->z - 1, 1)[0];
        }
        return $result;
    }

    public function __toString(): string
    {
        return sprintf('Obj( Num vertices: %d, Num normals: %d, Num faces: %d )', count($this->vertices), count($this->normals), count($this->verticesIndices));
    }
}
