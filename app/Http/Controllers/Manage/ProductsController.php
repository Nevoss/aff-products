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

    /**
     * Fetch single Prodcut
     *
     * @param  Product $product
     * @return ProdcutResource
     */
    public function show(Product $product)
    {
        return (new ProductResource($product));
    }

    /**
     * Update Prodcut
     *
     * @param  Product $product
     * @return Response
     */
    public function update(Product $product)
    {
        request()->validate([
            'title' => 'required',
            'categories_ids' => 'nullable|array',
            'categories_ids.*' => 'numeric|exists:categories,id'
        ]);

        $product->update(request()->all('title', 'description'));

        $product->categories()->sync(request('categories_ids'));

        return response()->json([], 200);
    }

    /**
     * Destroy Product record
     *
     * @param  Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([], 204);
    }
}
