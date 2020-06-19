<?php

declare(strict_types=1);

namespace Mammoth\Graphic;

class WavefrontObj
{

    /**
     * @var array
     */
    public $vertices;

    /**
     * @var array
     */
    public $verticesIndices;

    /**
     * @var array
     */
    public $textureCoordinates;

    /**
     * @var array
     */
    public $normals;

    public function __construct()
    {
        $this->vertices = [];
        $this->verticesIndices = [];
        $this->textureCoordinates = [];
        $this->normals = [];
    }

    public function getIndicesAsFloatArray()
    {
        $result = [];
        foreach ($this->verticesIndices as $vertex) {
            $result[] = $vertex->x;
            $result[] = $vertex->y;
            $result[] = $vertex->z;
        }

        return $result;
    }

    public function getVerticesAsFloatArray()
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

    /**
     * @return array
     */
    public function getVertices()
    {
        return $this->vertices;
    }

    /**
     * @return array
     */
    public function getVertexNormals()
    {
        return $this->normals;
    }

    /**
     * @return array
     */
    public function getVertexFaces()
    {
        return $this->verticesIndices;
    }

    /**
     * @return array
     */
    public function getTextureCoordinates()
    {
        return $this->textureCoordinates;
    }

    public function getIndices()
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

    public function __toString()
    {
        return sprintf('Obj( Num vertices: %d, Num normals: %d, Num faces: %d )', count($this->vertices), count($this->normals), count($this->verticesIndices));
    }
}
