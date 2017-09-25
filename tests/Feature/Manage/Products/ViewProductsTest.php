<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Category;

class ViewProductsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_view_all_the_products()
    {
        create(Product::class, [], 3);

        $response = $this->getJson('/manage/api/products')
            ->json();

        $this->assertCount(3, $response['data']);
    }

    /** @test */
    public function an_admin_can_filter_products_with_categories()
    {
        $category = create(Category::class);
        $secCategory = create(Category::class);
        $thirdCategory = create(Category::class);

        create(Product::class)->categories()->attach($category->id);
        create(Product::class)->categories()->attach($secCategory->id);
        create(Product::class)->categories()->attach($thirdCategory->id);

        $response = $this->getJson("/manage/api/products?category[]={$category->slug}&category[]={$secCategory->slug}")
            ->json();

        $this->assertCount(2, $response['data']);
    }

    /** @test */
    public function an_admin_can_fetch_single_product()
    {
        $product = create(Product::class);

        $response = $this->getJson("/manage/api/products/{$product->id}")->json();

        $this->assertEquals($product->id, $response['data']['id']);
    }

}
