<?php
namespace App\Filters;

use App\Filters\Filters;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductFilters extends Filters
{
    /**
     * Filters that can be excute
     * @var array
     */
    protected $filters = ['price', 'latest', 'search'];

    /**
     * Order by price
     * @param  string $value
     * @return void
     */
    public function price($value)
    {
        if(!in_array($value, ['asc', 'desc'])) {
            return;
        }

        $this->builder->getQuery()->orders = [];

        $this->builder->orderBy('price', $value);
    }

    /**
     * get the latest first
     *
     * @return void
     */
    public function latest()
    {
        $this->builder->getQuery()->orders = [];

        $this->builder->latest();
    }

    /**
     * Search filter
     *
     * @param  string $value
     * @return void
     */
    public function search($value)
    {
        $this->builder->where('title', 'LIKE', "%{$value}%");
    }

}
