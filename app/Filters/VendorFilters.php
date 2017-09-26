<?php
namespace App\Filters;

use App\Filters\Filters;

class VendorFilters extends Filters
{
    /**
     * Filters that can be excute
     *
     * @var array
     */
    protected $filters = ['active'];

    /**
     * brings the vendors that have or dont have class_path attr
     *
     * @param  string $value
     * @return void
     */
    public function active($value)
    {
        $this->builder->active($value);
    }
}
