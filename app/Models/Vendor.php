<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
     * overwrite timestamps prop
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * guarded columns
     *
     * @var array
     */
    protected $guarded = [];
}
