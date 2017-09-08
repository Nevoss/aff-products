<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
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
