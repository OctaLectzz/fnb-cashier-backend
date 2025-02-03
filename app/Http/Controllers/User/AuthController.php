<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $request)
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
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        Auth::login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'Register Successfully',
            'data' => new UserResource($user)
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $success['token'] =  $user->createToken('japanetz', ['*'], now()->addWeek())->plainTextToken;
            $success['user'] =  new UserResource($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Login Successfully',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau Kata Sandi masih salah'
            ], 403);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logout Successfully'
        ]);
    }
}
