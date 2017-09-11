<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;

class UpdateCategoriesTest extends TestCase
{
    protected $parentCategory;

    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->parentCategory = create(Category::class, [
            'name' => 'a',
            'description' => 'a',
        ])->fresh();

        // $this->withoutExceptionHandling();
    }

    /** @test */
    public function name_must_be_required()
    {
        $this->patch("/manage/api/categories/{$this->parentCategory->slug}", [
            'name' => '',
        ])->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function description_must_be_required()
    {
        $this->patch("/manage/api/categories/{$this->parentCategory->slug}", [
            'description' => '',
        ])->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function parent_id_must_be_valid()
    {
        $this->patch("/manage/api/categories/{$this->parentCategory->slug}", [
            'parent_id' => 9999,
        ])->assertSessionHasErrors(['parent_id']);
    }

    /** @test */
    public function an_admin_can_update_category()
    {
        $this->patch("/manage/api/categories/{$this->parentCategory->slug}", [
            'name' => 'b',
            'description' => 'b',
            'parent_id' => $this->parentCategory->id,
        ]);

        $this->assertDatabaseHas('categories', [
          'name' => 'b',
          'description' => 'b',
        ]);

    }

}
