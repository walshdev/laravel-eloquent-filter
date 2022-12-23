<?php

namespace Walshdev\LaravelEloquentFilter\Traits;

trait SplitValue
{
	/**
	 * Undocumented function
	 *
	 * @param string $value
	 * @return array
	 */
	public function sanitize(string $value)
	{
		return $this->split($value);
	}
}
