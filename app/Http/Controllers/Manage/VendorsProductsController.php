<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VendorsIntegration\VendorsIntegrationManager;

class VendorsProductsController extends Controller
{
    /**
     * Hold the vendor integration object
     *
     * @var VendorsIntegrationInterface
     */
    protected $vendorInegration;

    /**
     * Vendor Model
     *
     * @var Vendor
     */
    protected $vendorModel;

    /**
     * create VendorsProductsController Class
     *
     * @param VendorsIntegrationManager $vendorsIntegrationManager
     */
    public function __construct(VendorsIntegrationManager $vendorsIntegrationManager)
    {
        $this->vendorInegration = $vendorsIntegrationManager->getVendorIntegration();
        $this->vendorModel = $vendorsIntegrationManager->getVendorModel();
    }

    /**
     * TODO: write a unit test for VendorsIntegration and for this method
     * 
     * store product, recive an item id the fetch from the vendor the item details
     * then it store it
     *
     * @param  integer $vendorId
     * @return Response
     */
    public function store($vendorId)
    {
        request()->validate([
            'title' => 'required',
            'item_id' => 'required',
            'categories_ids' => 'required|array',
            'categories_ids.*' => 'numeric|exists:categories,id'
        ]);

        $itemData = $this->vendorInegration->getItemById(
            request('item_id')
        );

        $this->vendorModel->createProduct(
            $itemData, request()->all('title', 'description')
        );

        return response()->json([], 204);
    }
}
