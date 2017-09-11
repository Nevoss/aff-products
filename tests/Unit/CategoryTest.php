<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Category;

class CategoryTest extends TestCase
{
    /** @test */
    public function every_time_create_or_update_category_slug_is_generated()
    {
        $category = create(Category::class);

        $this->assertEquals(str_slug($category->name), $category->slug);

        $category->name = $newName =  'something else';
        $category->save();

        $this->assertEquals(str_slug($newName), $category->fresh()->slug);
    }

    /** @test */
    public function a_parent_category_can_get_all_his_childrens_ids()
    {
        $parent = create(Category::class);

        $child = create(Category::class, ['parent_id' => $parent->id]);
        $child2 = create(Category::class, ['parent_id' => $parent->id]);

        $grandChild = create(Category::class, ['parent_id' => $child->id]);

        $this->assertCount(4, $parent->getAllChildsIds());
    }

    /** @test */
    public function when_deleting_all_the_child_categoris_will_be_deleted_and_products_detach()
    {
        $anotherCategory = create(Category::class);

        $parent = create(Category::class);
        $child = create(category::class, [ 'parent_id' => $parent->id ]);
        create(Category::class, [ 'parent_id' => $child->id ]);

        $parentProduct = create(Product::class);
        $parentProduct->categories()->attach([$parent->id, $anotherCategory->id]);

        $childProduct = create(Product::class);
        $childProduct->categories()->attach([$child->id, $anotherCategory->id]);

        $parent->delete();

        $this->assertCount(1, Category::get()->toArray());
        $this->assertCount(1, $parentProduct->fresh()->categories->toArray());
        $this->assertCount(1, $childProduct->fresh()->categories->toArray());

    }

}
