<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductTest extends TestCase
{
    /** @test */
    public function its_delete_the_image_after_the_product_deleted()
    {
        Storage::fake('public');

        $product = create(Product::class, [
            'image' => $filePath = UploadedFile::fake()->image('product.jpg')->store('products', 'public'),
        ]);

        $product->delete();

        Storage::disk('public')->assertMissing($filePath);
    }

}
