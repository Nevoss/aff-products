<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

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
        // Create Filter
    }

}
