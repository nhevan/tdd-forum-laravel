<?php
namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
	protected $request;
	protected $builder;
	protected $filters = [];

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * applies the filter to the query object
	 * @param  [type] $builder [description]
	 * @return [type]          [description]
	 */
	public function apply($builder)
	{
		$this->builder = $builder;

		foreach ($this->getFilters() as $filter => $value) {
			if (method_exists($this, $filter)) {
				$this->$filter($value);
			}
		}

        return $this->builder;
	}

	private function getFilters()
	{
		return $this->request->intersect($this->filters);
	}
}