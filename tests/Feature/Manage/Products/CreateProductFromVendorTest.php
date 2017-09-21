<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;

class createProductFromVendorTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_create_product_from_vendor_with_vendor_product_id()
    {
        $category = create(Category::class);

        $response = $this->postJson("/manage/api/vendors/1/product", [
            'title' => 'somthing',
            'description' => 'else',
            'item_id' => 172874319724,
            'categories_ids' => [$category->id],
        ])->assertStatus(204);

        $this->assertDatabaseHas('products', [
            'title' => 'somthing',
        ]);

    }


}
