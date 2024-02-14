<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return response()->json($permissions, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = new permission();
        $permission->route_id = $request->route_id;
        $permission->role_id = $request->role_id;
        $permission->save();
        return response()->json($permission, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $Permission)
    {
        return response()->json($Permission, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $Permission)
    {
        $Permission->route_id = $request->route_id;
        $Permission->role_id = $request->role_id;
        $Permission->save();
        return response()->json($Permission, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $Permission)
    {
        $Permission->delete();
        return response()->json(null, 204);
    }
}
