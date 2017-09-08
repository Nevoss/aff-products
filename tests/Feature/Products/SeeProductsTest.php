<?php

namespace Tests\Feature\Products;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class SeeProductsTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function a_visitor_can_see_all_the_products()
    {
        create(Product::class, [], 2);

        $response = $this->getJson('/api/products')->json();

        $this->assertCount(2, $response['data']);
    }

    /** @test */
    public function a_visitor_can_visit_products_index_page()
    {
        $this->get('/products')
            ->assertSee('All Products');
    }

    /** @test */
    public function a_visitor_can_filter_products_throw_categories()
    {
        $firstCategory = create(Category::class);

        create(Product::class);
        $product = create(Product::class)
            ->categories()
            ->attach($firstCategory->id);

        $response = $this->getJson("/api/products/{$firstCategory->slug}")->json();

        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function a_visitor_can_filter_products_with_parent_categories_and_see_products_from_child_categories()
    {
        $parentCategory = create(Category::class);
        create(Product::class)->categories()->attach($parentCategory->id);

        $childCategory = create(Category::class, [ 'parent_id' => $parentCategory->id ]);
        create(Product::class)->categories()->attach($childCategory->id);
        create(Product::class)->categories()->attach([$childCategory->id, $parentCategory->id]);

        $response = $this->getJson("/api/products/{$parentCategory->slug}")->json();

        $this->assertCount(3, $response['data']);
    }

    /** @test */
    public function a_visitor_can_visit_category_page()
    {
        $category = create(Category::class);

        $this->get("/products/{$category->slug}")
            ->assertSee($category->name)
            ->assertSee($category->description);
    }

    /** @test */
    public function a_visitor_can_order_products_by_price()
    {
        create(Product::class, [ 'price' => 1.00 ]);
        create(Product::class, [ 'price' => 8.00 ]);
        create(Product::class, [ 'price' => 4.00 ]);

        $expectedOrder = [1.00, 4.00, 8.00];

        $response = $this->getJson("/api/products?price=asc")->json();

        $this->assertEquals($expectedOrder, array_column($response['data'], 'price'));

        $response = $this->getJson("/api/products?price=desc")->json();

        $this->assertEquals(array_reverse($expectedOrder), array_column($response['data'], 'price'));
    }

    /** @test */
    public function a_visitor_can_order_products_by_latest_product()
    {
        $first = create(Product::class, [ 'created_at' => Carbon::now() ]);
        $third = create(Product::class, [ 'created_at' => Carbon::now()->subDays(6) ]);
        $sec = create(Product::class, [ 'created_at' => Carbon::now()->subDays(3) ]);

        $response = $this->getJson('/api/products?latest=1')->json();

        $this->assertEquals([ $first->id, $sec->id, $third->id ], array_column($response['data'], 'id'));

    }

    /** @test */
    public function a_visitior_can_search_for_product()
    {
        create(Product::class, [ 'title' => 'abc' ]);
        create(Product::class, [ 'title' => 'kkk' ]);

        $response = $this->getJson('/api/products?search=ab')->json();

        $this->assertCount(1, $response['data']);
    }

}
