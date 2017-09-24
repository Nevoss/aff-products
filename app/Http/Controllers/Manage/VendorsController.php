<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Filters\VendorFilters;

class VendorsController extends Controller
{
    public function index(VendorFilters $filters)
    {
        return VendorResource::collection(
            Vendor::filter($filters)->get()
        );
    }
}
