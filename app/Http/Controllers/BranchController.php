<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\BranchResource;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::oldest()->get();

        return BranchResource::collection($branches);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:15|regex:/^[0-9]+$/',
            'address' => 'nullable'
        ]);

        // Branch Code
        do {
            $branchCode = strtoupper(Str::random(8));
        } while (Branch::where('branch_code', $branchCode)->exists());
        $data['branch_code'] = $branchCode;

        // Image
        if ($request->hasFile('image')) {
            $imageName = 'IMG' . time() . '-' . Str::slug($data['name']) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('branches'), $imageName);
            $data['image'] = $imageName;
        }

        $branch = Branch::create($data);

        // Create Default Roles
        $roles = ['Manager', 'Cashier', 'Waitress', 'Kitchen'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'branch_id' => $branch->id,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Branch Created Successfully',
            'data' => new BranchResource($branch)
        ]);
    }

    public function show(Branch $branch)
    {
        return response()->json([
            'data' => new BranchResource($branch)
        ]);
    }

    public function update(Request $request, Branch $branch)
    {
        $data = $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:15|regex:/^[0-9]+$/',
            'address' => 'nullable',
            'status' => 'required|boolean'
        ]);

        // Image
        if ($request->hasFile('image')) {
            $imageName = 'IMG' . time() . '-' . Str::slug($data['name']) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('branches'), $imageName);
            $data['image'] = $imageName;
        }

        $branch->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Branch Edited Successfully',
            'data' => new BranchResource($branch)
        ]);
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Branch Deleted Successfully'
        ]);
    }
}
