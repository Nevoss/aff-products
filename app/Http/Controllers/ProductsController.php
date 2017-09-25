<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Filters\ProductFilters;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    /**
     * Return the view of all products
     *
     * @return View
     */
    public function view(Category $category)
    {
        return view('products.index', [
            'category' => $category
        ]);
    }

    /**
     * Get all the products
     *
     * @return ProductResource
     */
    public function index(Category $category, ProductFilters $filters)
    {
        $products = $this->getProducts($category, $filters);

        return ProductResource::collection(
            $products
        );
    }

    /**
     * Get all the products
     *
     * @param  Category       $category
     * @param  ProductFilters $filters
     * @return Collecion
     */
    protected function getProducts(Category $category, ProductFilters $filters)
    {
        $products = ($category->exists) ? $category->allAssociatedProducts() : new Product;

        return $products
            ->latest()
            ->filter($filters)
            ->get();
    }
}
