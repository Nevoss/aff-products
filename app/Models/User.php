<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\UserFilters;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Chnage the default that come from the database to what Expected
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean'
    ];

    /**
     * Overwirte password attr on set
     *
     * @param string $password
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Check if user is Admin
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * activate Filters class
     *
     * @param  Builder        $builder
     * @param  UserFilters $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, UserFilters $filters)
    {
        return $filters->apply($builder);
    }
}
