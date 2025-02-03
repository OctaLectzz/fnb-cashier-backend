<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'nullable|string|max:15',
            'birthday' => 'nullable|date',
            'address' => 'nullable',
            'bio' => 'nullable'
        ]);

        // Image
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->name . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('users'), $imageName);
            $data['image'] = $imageName;
        }

        // Password
        $data['password'] = bcrypt($$request->password);

        $user = User::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'User Created Successfully',
            'data' => new UserResource($user)
        ]);
    }

    public function show(User $user)
    {
        return response()->json([
            'data' => new UserResource($user)
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:8',
            'phone_number' => 'nullable|string|max:15',
            'birthday' => 'nullable|date',
            'address' => 'nullable',
            'bio' => 'nullable'
        ]);

        // Image
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->name . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('users'), $imageName);
            $data['image'] = $imageName;
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'User Edited Successfully',
            'data' => new UserResource($user)
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User Deleted Successfully'
        ]);
    }
}
