<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;

class DeleteCategoriesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        // $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_delete_category()
    {
        $parent = create(Category::class);
        $childCat = make(Category::class);

        $response = $this->delete("/manage/api/categories/{$parent->slug}");

        $this->assertDatabaseMissing('categories', [
            'id' => $parent->id
        ]);
        $this->assertDatabaseMissing('categories', [
            'id' => $childCat->id
        ]);
    }
}
