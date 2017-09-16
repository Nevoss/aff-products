<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Filters\ProductFilters;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ManageProductsController extends Controller
{
    public function index(ProductFilters $filter)
    {
        $products = Product::latest()->filter($filter)->get();

        return ProductResource::collection(
            $products
        );
    }
}
