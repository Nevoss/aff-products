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
     * hide props in searlize to json
     *
     * @var array
     */
    protected $hidden = ['class_path'];

    /**
     * guarded columns
     *
     * @var array
     */
    protected $guarded = [];
}
