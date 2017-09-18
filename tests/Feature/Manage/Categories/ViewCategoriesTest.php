<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;

class ViewCategoriesTest extends TestCase
{
    /** @test */
    public function an_admin_can_view_all_the_categories_and_all_the_childs_categories()
    {
        $this->signInAsAdmin();

        $parent = create(Category::class);
        $child = create(Category::class, [
            'parent_id' => $parent->id
        ]);
        $grandChid = create(Category::class, [
            'parent_id' => $child->id
        ]);

        $anotherParent = create(Category::class);

        $response = $this->getJson('/manage/api/categories')->json();

        $this->assertCount(2, $response['data']);
        $this->assertEquals($child->id, $response['data'][0]['child_categories'][0]['id']);
        $this->assertEquals($grandChid->id, $response['data'][0]['child_categories'][0]['child_categories'][0]['id']);
    }

    /** @test */
    public function an_admin_can_fetch_single_category()
    {
        $this->signInAsAdmin();

        $category = create(Category::class);

        $response = $this->getJson("/manage/api/categories/{$category->slug}")->json();

        $this->assertEquals($category->id, $response['data']['id']);
    }

}
