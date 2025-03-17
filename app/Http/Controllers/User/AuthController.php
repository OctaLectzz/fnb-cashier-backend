<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Employee\EmployeeResource;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone_number' => 'nullable|string|max:15'
        ]);

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
            $success['token'] =  $user->createToken('winepos', ['*'], now()->addWeek())->plainTextToken;
            $success['user'] =  new UserResource($user);

            return response()->json([
                'status' => 'success',
                'message' => 'Login Successfully',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or Password is still incorrect'
            ], 403);
        }
    }

    public function employee(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Please login as user first'], 403);
        }

        $request->validate([
            'nip' => 'required|exists:employees,nip',
            'pin' => 'required|digits:6'
        ]);

        $employee = Employee::where('nip', $request->nip)->where('user_id', Auth::id())->first();

        if ($employee && $employee->pin === $request->pin) {
            $success['token'] = $employee->createToken('employee-token')->plainTextToken;
            $success['employee'] =  new EmployeeResource($employee);

            return response()->json([
                'status' => 'success',
                'message' => 'Employee Login Successfully',
                'data' => $success
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid NIP or PIN'
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
