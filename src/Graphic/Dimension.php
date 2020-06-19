<?php

declare(strict_types=1);

namespace Mammoth\Graphic;

class Dimension
{

	public $w, $h;

	public function __construct(int $w, int $h)
	{
		$this->w = $w;
		$this->h = $h;
	}
}
