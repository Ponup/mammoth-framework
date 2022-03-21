<?php declare(strict_types=1);

namespace Mammoth\Graphic;

class Color
{
	public function __construct(public float $r,
		public float $g,
		public float $b,
		public float $a = 0)
	{
	}

	public function times(Color $other): Color
	{
		return new Color(
			$this->r * $other->r,
			$this->g * $other->g,
			$this->b * $other->b,
			$this->a * $other->a
		);
	}

	public function clamp()
	{
		return new Color(
			max(min($this->r, 1), 0),
			max(min($this->g, 1), 0),
			max(min($this->b, 1), 0),
			max(min($this->a, 1), 0),
		);
	}
}
