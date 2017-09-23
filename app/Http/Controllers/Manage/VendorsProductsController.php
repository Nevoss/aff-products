<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VendorsIntegration\VendorsIntegrationInterface;
use App\Models\Vendor;

class VendorsProductsController extends Controller
{
    /**
     * Hold the vendor integration object
     *
     * @var VendorsIntegrationInterface
     */
    protected $vendorInegration;

    /**
     * create VendorsProductsController Class
     *
     * @param VendorsIntegrationManager $vendorsIntegrationManager
     */
    public function __construct(VendorsIntegrationInterface $vendorsIntegration)
    {
        $this->vendorInegration = $vendorsIntegration;
    }

    /**
     * store product, recive an item id the fetch from the vendor the item details
     * then it store it
     *
     * @param  integer $vendorId
     * @return Response
     */
    public function store(Vendor $vendor)
    {
        request()->validate([
            'title' => 'required',
            'item_id' => 'required',
            'categories_ids' => 'nullable|array',
            'categories_ids.*' => 'numeric|exists:categories,id'
        ]);

        $itemData = $this->vendorInegration->getItemById(
            request('item_id')
        );

        $vendor->createProduct($itemData, request()->all('title', 'description'))
            ->categories()
            ->sync(request('categories_ids', []));

        return response()->json([], 204);
    }
}
