<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * The Request object injected in
     *
     * @var Request
     */
    protected $request;

    /**
     * The Eloquent builder object
     *
     * @var Builder
     */
    protected $builder;

    /**
     * filters that can be
     *
     * @var array
     */
    protected $filters = [];

    /**
     * Create Filters Object
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Excute all the filters that requested
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        $filters = $this->getFilters();

        $filters->keys()
            ->filter(function($filter) {
                return method_exists($this, $filter);
            })->each(function ($filter) use ($filters) {
                $this->{$filter}($filters[$filter]);
            });

        return $this->builder;
    }

    /**
     * Fetch all the filters
     *
     * @return Collection
     */
    protected function getFilters()
    {
        return collect($this->request->only($this->filters));
    }
}
