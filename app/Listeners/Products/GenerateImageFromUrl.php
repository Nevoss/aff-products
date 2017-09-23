<?php

namespace App\Listeners\Products;

use Illuminate\Http\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Products\ProductCreatedFromVendor;

class GenerateImageFromUrl
{
    /**
     * Image Manager
     *
     * @var ImageManager
     */
    protected $imgManager;

    /**
     * Product Model
     *
     * @var Product
     */
    protected $product;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->imgManager = new ImageManager;
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreatedFromVendor  $event
     * @return void
     */
    public function handle(ProductCreatedFromVendor $event)
    {
        $this->product = $event->product;

        $imgStream = $this->generateImgStream();

        $imgName = $this->generateUniqeName();

        $filePath = Storage::put($storagePath = "products/{$imgName}", $imgStream);

        $this->updateProduct($storagePath);
    }

    /**
     * Resize the image and generate jpg stream
     *
     * @return mixed
     */
    protected function generateImgStream()
    {
        return $this->imgManager
            ->make($this->product->image)
            ->fit(300, 225)
            ->stream('jpg', 80);
    }

    /**
     * Update Product Model
     *
     * @param  string $storagePath
     * @return void
     */
    protected function updateProduct($storagePath)
    {
        $this->product->update([
            'image' => $storagePath,
        ]);
    }

    /**
     * Generate unique name for the image
     *
     * @return string
     */
    protected function generateUniqeName()
    {
        return uniqid($this->product->id) . '.jpg';
    }
}
