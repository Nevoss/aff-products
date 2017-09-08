<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(Category::class, 4)->create();

        factory(Product::class, 40)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories[array_rand($categories->toArray())]->id
            );
        });
    }
}
