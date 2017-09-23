<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use App\VendorsIntegration\Responses\ItemResponses\ItemResponseAbstract;
use App\Events\Products\ProductCreatedFromVendor;

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
