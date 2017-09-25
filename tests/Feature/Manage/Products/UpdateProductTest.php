<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Category;

class UpdateProductTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        // $this->withoutExceptionHandling();
    }

    /** @test */
    public function title_is_required_when_updating_product()
    {
        $product = create(Product::class, [
            'title' => 'a',
            'description' => 'a',
        ]);

        $response = $this->patchJson("/manage/api/products/{$product->id}", [
            'title' => '',
            'description' => 'b',
        ])->json();

        $this->assertArrayHasKey('title', $response['errors']);
    }

    /** @test */
    public function categories_ids_must_be_valid_when_updating_product()
    {
        $category = create(Category::class);

        $product = create(Product::class, [
            'title' => 'a',
            'description' => 'a',
        ]);

        $response = $this->patchJson("/manage/api/products/{$product->id}", [
            'title' => 'a',
            'description' => 'b',
            'categories_ids' => [999, 998, 'asd', $category->id],
        ])->json();
        
        $this->assertArrayHasKey('categories_ids.0', $response['errors']);
        $this->assertArrayHasKey('categories_ids.1', $response['errors']);
        $this->assertArrayHasKey('categories_ids.2', $response['errors']);

        $this->assertArrayNotHasKey('categories_ids.3', $response['errors']);
    }

    /** @test */
    public function an_admin_can_update_product()
    {
        $category = create(Category::class);
        $secCatgeory = create(Category::class);

        $product = create(Product::class, [
            'title' => 'a',
            'description' => 'a',
        ]);

        $product->categories()->sync([$category->id]);

        $this->patchJson("/manage/api/products/{$product->id}", [
            'title' => 'b',
            'description' => 'b',
            'categories_ids' => [$category->id, $secCatgeory->id],
        ]);

        $this->assertDatabaseMissing('products', [
            'title' => 'a',
            'description' => 'a'
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'b',
            'description' => 'b'
        ]);

        $this->assertCount(2, $product->fresh()->categories);

    }
}
