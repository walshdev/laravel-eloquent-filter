<?php

namespace Walshdev\LaravelEloquentFilter\Filters;

use Illuminate\Database\Eloquent\Builder;
use Walshdev\LaravelEloquentFilter\Filter;
use Walshdev\LaravelEloquentFilter\Traits\SplitValue;

class WhereIn extends Filter
{
	use SplitValue;

    /**
     * Apply the filter after sanitize
	 *
     * @param mixed $value
     * @param  Builder  $builder
	 * @return void
     */
    public function apply($value, Builder $builder): void
    {
        $builder->whereIn($this->column(), $value);
    }
}
