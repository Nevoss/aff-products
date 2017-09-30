<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class AdminsController extends Controller
{
    /**
     * Return the view of this section
     *
     * @return View
     */
    public function view()
    {
        return view('manage.admins');
    }

    /**
     * Fetch all the admins
     *
     * @return UserResource
     */
    public function index()
    {
        return UserResource::collection(
            User::where('is_admin', true)->paginate(1)
        );
    }
}
