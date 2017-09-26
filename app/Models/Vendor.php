<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\VendorsIntegration\Responses\ItemResponses\ItemResponseAbstract;
use App\Events\Products\ProductCreatedFromVendor;
use App\Filters\VendorFilters;

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

    /**
     * Reletion with products
     *
     * @return Product
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * activate Filters class
     *
     * @param  Builder        $builder
     * @param  VendorFilters $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, VendorFilters $filters)
    {
        return $filters->apply($builder);
    }

    /**
     * brings the vendors that have or dont have class_path attr
     *
     * @param  Builder $builder
     * @param  boolean $isActive
     * @return void
     */
    public function scopeActive(Builder $builder, $isActive = true)
    {
        if (!$isActive) {
            $builder->whereNull('class_path');
            return;
        }

        $builder->whereNotNull('class_path');
    }

    /**
     * Create a product model from a vendor integration response
     *
     * @param  ItemResponseAbstract $itemData
     * @param  array                $extraAttributes
     * @return Product
     */
    public function createProduct(ItemResponseAbstract $itemData, array $extraAttributes)
    {
        $data = array_merge([
            'vendor_product_id' => $itemData->itemId,
            'price' => $itemData->price,
            'image' => $itemData->image,
            'link' => $itemData->link,
        ], $extraAttributes);

        $product = $this->products()->create($data);

        event(new ProductCreatedFromVendor($product));

        return $product;
    }
}
