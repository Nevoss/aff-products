<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\CategoryResource;

class CategoryResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'child_categories' => CategoryResource::collection($this->getChildCategories()),
         ];
    }

    protected function getChildCategories()
    {
        return $this->recursiveChildCategories ?: $this->childCategories ?: collect();
    }
}
