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
            'avatar' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone_number' => 'nullable|string|max:15',
            'ktp' => 'nullable|string|max:16',
            'ktp_image' => 'nullable',
            'npwp' => 'nullable|string|max:30',
            'npwp_image' => 'nullable'
        ]);

        // Avatar
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '-' . $request->name . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatars'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        // KTP
        if ($request->hasFile('ktp_image')) {
            $ktpImageName = time() . '-' . $request->name . '.' . $request->ktp_image->getClientOriginalExtension();
            $request->ktp_image->move(public_path('users/ktps'), $ktpImageName);
            $data['ktp_image'] = $ktpImageName;
        }

        // NPWP
        if ($request->hasFile('npwp_image')) {
            $npwpImageName = time() . '-' . $request->name . '.' . $request->npwp_image->getClientOriginalExtension();
            $request->npwp_image->move(public_path('users/npwps'), $npwpImageName);
            $data['npwp_image'] = $npwpImageName;
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
