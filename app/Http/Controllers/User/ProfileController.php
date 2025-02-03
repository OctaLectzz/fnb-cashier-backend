<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class ProfileController extends Controller
{
    public function profile(User $user)
    {
        $user = auth()->user();

        return response()->json([
            'data' => new UserResource($user)
        ]);
    }

    public function editprofile(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
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

        $user = User::find(auth()->id());
        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile Edited Successfully',
            'data' => new UserResource($user)
        ]);
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user = User::findOrFail(auth()->id());

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The current password is incorrect',
                'data' => null
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password Edited Successfully',
            'data' => new UserResource($user)
        ]);
    }
}
