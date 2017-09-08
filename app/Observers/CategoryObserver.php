<?php
namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Hit the method when saving category
     *
     * @param  Category $category
     * @return void
     */
    public function saving(Category $category)
    {
        $category->slug = str_slug($category->name);
    }
}
