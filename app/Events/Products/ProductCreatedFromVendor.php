<?php

namespace App\Events\Products;

use App\Models\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ProductCreatedFromVendor
{
    use Dispatchable, SerializesModels;

    /**
     * Product Model
     *
     * @var Product
     */
    public $product;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
