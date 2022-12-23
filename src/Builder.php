<?php

namespace Walshdev\LaravelEloquentFilter;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Walshdev\LaravelHelpers\Data;

class Builder
{
	/**
	 * Экземпляр запроса
	 *
	 * @var \Illuminate\Database\Eloquent\Builder
	 */
	private EloquentBuilder $query;

	/**
	 * Фильтры объявленные в модели
	 *
	 * @var array
	 */
	private array $filters;

	/**
	 * Фильтры из запроса
	 *
	 * @var \Walshdev\LaravelHelpers\Data
	 */
	private Data $data;

	/**
	 * Конструктор класса
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param array $filters
	 * @param array $data
	 */
	public function __construct(EloquentBuilder $query, array $filters, array $data)
	{
		$this->query = $query;
		$this->filters = $filters;
		$this->data = new Data($data);
	}

	/**
	 * Подготовка значения
	 *
	 * @param LaravelGreatApi\Eloquent\Query\Filters\Filter $filter
	 * @param mixed $value
	 * @return mixed
	 */
	private function prepareValue(Filter $filter, mixed $value): mixed
	{
		if ($filter->hasSanitize()) {
			return $filter->sanitize($value);
		}

		return $value;
	}

	/**
	 * Обход объявленных фильтров в цикле
	 *
	 * @param callable $callback
	 * @return void
	 */
	private function eachFilters(callable $callback)
	{
		foreach($this->filters as $filter) {
			if ($value = $this->data->get($filter->name())) {
				$callback($filter, $this->prepareValue($filter, $value));
			}
		}
	}

	/**
	 * Собрать и вернуть запрос
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function build(): EloquentBuilder
	{
		$this->eachFilters(
			fn(Filter $filter, $value) => $filter->apply($value, $this->query)
		);

		return $this->query;
	}
}
