<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Listeners\Products\GenerateImageFromUrl;
use App\Events\Products\ProductCreatedFromVendor;

class GenerateImageFromUrlTest extends TestCase
{
    /** @test */
    public function it_take_a_vendor_image_url_change_it_and_store_it()
    {
        $product = create(Product::class);

        $listener = new GenerateImageFromUrl();
        $listener->handle(new ProductCreatedFromVendor($product));
    }
}
