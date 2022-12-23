<?php

namespace Walshdev\LaravelEloquentFilter\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Walshdev\LaravelEloquentFilter\Builder as FilterBuilder;

trait Filterable
{
	/**
	 * Undocumented function
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param array $filters
	 * @return object
	 */
	private function filterBuilder(Builder $query, array $data)
	{
		if (method_exists($this, 'filters')) {
			return new FilterBuilder($query, $this->filters(), $data);
		} else {
			throw new Exception("Необходимо объявить фильтры в модели");
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeFilter(Builder $query, array $data)
	{
		return $this->filterBuilder($query, $data)->build();
	}
}
