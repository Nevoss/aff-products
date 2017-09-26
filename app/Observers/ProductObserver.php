<?php
namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Hit the method when delete a product
     *
     * @param  Product $prodcut
     * @return void
     */
    public function deleted(Product $product)
    {
        if (!Storage::exists($product->image)) {
            return;
        }

        Storage::delete($product->image);
    }
}
