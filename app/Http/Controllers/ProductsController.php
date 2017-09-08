<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Return the view of all products
     *
     * @return View
     */
    public function index(Category $category)
    {
        return view('products.index', [
            'category' => $category
        ]);
    }
}
