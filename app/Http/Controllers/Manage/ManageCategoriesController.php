<?php

namespace App\Http\Controllers\Manage;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class ManageCategoriesController extends Controller
{
    /**
     * show the view of categories
     *
     * @return View
     */
    public function view()
    {
        return view('manage.categories');
    }

    /**
     * Get all the categories
     *
     * @return CategoryResource
     */
    public function index()
    {
        return CategoryResource::collection(
            Category::topLevel()->with('recursiveChildCategories')->get()
        );
    }

    /**
     * Store Category
     *
     * @return Response
     */
    public function store()
    {
        $data = $this->validateRequest();

        Category::create($data);

        return response()->json([], 204);
    }

    /**
     * Update Category
     *
     * @param  Category $category
     * @return Response
     */
    public function update(Category $category)
    {
        $data = $this->validateRequest();

        $category->update($data);

        return response()->json([], 204);
    }

    /**
     * Delete Category
     *
     * @param  Category $category
     * @return Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([], 204);
    }

    /**
     * Validate the request of update and store
     *
     * @param  mixed $categoryId
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);
    }

}
