<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageCategoriesController extends Controller
{
    public function view()
    {
        return view('manage.categories');
    }
}
