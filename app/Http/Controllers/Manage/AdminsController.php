<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Filters\UserFilters;

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
    public function index(UserFilters $filters)
    {
        return UserResource::collection(
            User::where('is_admin', true)->filter($filters)->paginate(10)
        );
    }

    /**
     * Store new Admin
     *
     * @return Response
     */
    public function store()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $admin = User::create(array_merge(
            request()->all('name', 'email', 'password'),
            [ 'is_admin' => true, ]
        ));

        return response()->json([], 204);
    }

    /**
     * Show single Admin
     *
     * @param  User   $admin
     * @return UserResource
     */
    public function show(User $admin)
    {
        if (!$admin->isAdmin()) {
            abort(404);
        }

        return new UserResource($admin);
    }

    /**
     * Update Admins
     *
     * @param  User   $admin
     * @return Response
     */
    public function update(User $admin)
    {
        request()->validate([
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$admin->id}",
            'is_new_password' => 'required|boolean',
            'password' => 'required_if:is_new_password,1'
        ]);

        if (!request('is_new_password')) {
            request()->offsetUnset('password');
        }

        $admin->update(request()->only(['name', 'email', 'password']));

        return response()->json([], 204);
    }

    /**
     * Delete an Admin
     *
     * @param  User   $admin
     * @return Reponse
     */
    public function destroy(User $admin)
    {
        $admin->delete();

        return response()->json([], 204);
    }
}
