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
            'avatar' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'nullable|string|max:15'
        ]);

        // Avatar
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '-' . $request->name . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $data['avatar'] = $avatarName;
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
            'avatar' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:15'
        ]);

        // Avatar
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '-' . $request->name . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $data['avatar'] = $avatarName;
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
