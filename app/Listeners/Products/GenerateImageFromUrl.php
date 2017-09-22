<?php

namespace App\Listeners\Products;

use App\Events\Products\ProductCreatedFromVendor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateImageFromUrl
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductCreatedFromVendor  $event
     * @return void
     */
    public function handle(ProductCreatedFromVendor $event)
    {
        $product = $event->product;
    }
}
