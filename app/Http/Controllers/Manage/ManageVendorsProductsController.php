<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VendorsIntegration\VendorsIntegrationManager;

class ManageVendorsProductsController extends Controller
{
    protected $vendorInegration;

    public function __construct(VendorsIntegrationManager $vendorsIntegrationManager)
    {
        $this->vendorInegration = $vendorsIntegrationManager->getVendorIntegration();
    }

    public function store($vendorId)
    {
        // TODO: write a unit test for VendorsIntegration and for this method
        
        $itemData = $this->vendorInegration->getItemById(123132);
    }
}
