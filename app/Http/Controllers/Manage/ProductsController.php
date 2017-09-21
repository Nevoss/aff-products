<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * show the view of products
     *
     * @return View
     */
    public function view()
    {
        return view('manage.products');
    }

    /**
     * Get all the products
     *
     * @param  ProductFilters $filter
     * @return ProductResource
     */
    public function index(ProductFilters $filter)
    {
        $products = Product::latest()->filter($filter)->paginate(10);

        return ProductResource::collection(
            $products
        );
    }
}
