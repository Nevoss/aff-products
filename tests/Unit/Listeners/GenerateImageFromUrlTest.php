<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Listeners\Products\GenerateImageFromUrl;
use App\Events\Products\ProductCreatedFromVendor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class GenerateImageFromUrlTest extends TestCase
{
    /** @test */
    public function it_take_a_vendor_image_url_change_it_and_store_it()
    {
        Storage::fake('public');

        $product = create(Product::class, [
            'image' => Storage::disk('tests')->url('testImg.png')
        ]);

        $listener = new GenerateImageFromUrl();
        $listener->handle(new ProductCreatedFromVendor($product));

        Storage::disk('public')->assertExists($product->fresh()->image);
    }
}
