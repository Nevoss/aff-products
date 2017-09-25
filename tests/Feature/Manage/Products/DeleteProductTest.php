<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class DeleteProductTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_delete_product()
    {
        $product = create(Product::class);

        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);

        $this->deleteJson("/manage/api/products/{$product->id}");

        $this->assertDatabaseMissing('products', [
            'id' => $product->id
        ]);
    }

}
