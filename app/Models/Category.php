<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class Category extends Model
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

    /**
     * hide props in searlize to json
     *
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * overwirte the route key name
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Reletion with Product Model
     *
     * @return Collection
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * return this Category products and all his related categories producs
     *
     * @return Collection
     */
    public function allAssociatedProducts()
    {
        return Product::whereHas('categories', function ($builder) {
            $builder->whereIn('category_id', $this->getAllChildsIds());
        });
    }

    /**
     * Reletion between category to category
     *
     * @return Category
     */
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Reletion between category to category
     *
     * @return Collection
     */
    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Recursive function that fetch all the Childs Ids
     * releted to the current Category
     *
     * @param  mixed $category
     * @return array
     */
    public function getAllChildsIds($category = false)
    {
        $category = (!$category) ? $this : $category;

        $ids = [];

        optional($category->childCategories)->each(function ($category) use (&$ids) {
            $ids = array_merge($ids, $this->getAllChildsIds($category));
        });

        $ids[] = $category->id;

        return $ids;

    }

    /**
     * get the categories that are not children of any category
     *
     * @param  Builder $builder
     * @return void           
     */
    public function scopeTopLevel(Builder $builder)
    {
        return $builder->where('parent_id', null);
    }
}
