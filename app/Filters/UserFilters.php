<?php
namespace App\Filters;

use App\Filters\Filters;

class UserFilters extends Filters
{
    /**
     * Filters that can be excute
     *
     * @var array
     */
    protected $filters = ['search'];

    /**
     * Search filter
     *
     * @param  string $value
     * @return void
     */
    public function search($value)
    {
        $this->builder
            ->where('name', 'LIKE', "%{$value}%")
            ->orWhere('email', 'LIKE', "%{$value}%");
    }
}
