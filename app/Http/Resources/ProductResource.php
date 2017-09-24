<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\VendorResource;
use App\Http\Resources\CategoryResource;

class ProductResource extends Resource
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
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'link' => $this->link,
            'image' => $this->storage_image,
            'vendor' => new VendorResource($this->vendor),
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
