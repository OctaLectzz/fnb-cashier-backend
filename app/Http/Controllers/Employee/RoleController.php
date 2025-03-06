<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Models\Employee\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\RoleResource;

class RoleController extends Controller
{
    public function index()
    {
        $categories = Role::latest()->get();

        return RoleResource::collection($categories);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string'
        ]);

        $role = Role::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Role Created Successfully',
            'data' => new RoleResource($role)
        ]);
    }

    public function show(Role $role)
    {
        return response()->json([
            'data' => new RoleResource($role)
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'string'
        ]);

        $role->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Role Edited Successfully',
            'data' => new RoleResource($role)
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Role Deleted Successfully'
        ]);
    }
}
