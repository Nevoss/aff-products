<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;

class CreateCategoriesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        // $this->withoutExceptionHandling();
    }

    /** @test */
    public function name_must_be_required()
    {
        $category = make(Category::class, [ 'name' => null ]);

        $response = $this->post('/manage/api/categories', $category->toArray())
            ->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function description_must_be_required()
    {
        $category = make(Category::class, [ 'description' => null ]);

        $response = $this->post('/manage/api/categories', $category->toArray())
            ->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function parent_id_must_be_valid()
    {
        $category = make(Category::class, [ 'parent_id' => 99 ]);

        $response = $this->post('/manage/api/categories', $category->toArray())
            ->assertSessionHasErrors(['parent_id']);
    }

    /** @test */
    public function an_admin_can_create_new_category()
    {
        $category = make(Category::class);

        $response = $this->post('/manage/api/categories', $category->toArray());

        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'description' => $category->description
        ]);
    }

    /** @test */
    public function an_admin_can_create_new_child_category()
    {
        $parent = create(Category::class);
        $childCat = make(Category::class);

        $response = $this->post('/manage/api/categories', array_merge($childCat->toArray(), [
            'parent_id' => $parent->id
        ]));

        $this->assertDatabaseHas('categories', [
            'name' => $childCat->name,
            'description' => $childCat->description,
            'parent_id' => $parent->id,
        ]);
    }
}
