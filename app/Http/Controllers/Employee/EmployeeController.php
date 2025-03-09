<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Employee\EmployeeResource;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('user_id', auth()->id())->latest()->get();

        return EmployeeResource::collection($employees);
    }

    public function profile()
    {
        $employee = Auth::guard('employee')->user();;

        return response()->json([
            'data' => new EmployeeResource($employee)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|string|max:20',
            'avatar' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'pin' => 'required|string|max:6',
            'branch_id' => 'required|exists:branches,id',
            'schedule_id' => 'required|exists:schedules,id',
            'ktp' => 'nullable|string|max:25',
            'ktp_image' => 'nullable',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'domicile' => 'nullable|string|max:255',
            'address' => 'nullable',
            'employment_status' => 'required',
            'date_joined' => 'required|date',
            'end_date' => 'nullable|date',
            'bpjs_tk_number' => 'nullable',
            'bpjs_tk_card' => 'nullable',
            'bpjs_health_number' => 'nullable',
            'bpjs_health_card' => 'nullable',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'status' => 'nullable|boolean'
        ]);
        $data['user_id'] = auth()->id();

        // Avatar
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '-' . $data['nip'] . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('employees/avatars'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        // KTP
        if ($request->hasFile('ktp_image')) {
            $ktpImageName = time() . '-' . $data['nip'] . '.' . $request->ktp_image->getClientOriginalExtension();
            $request->ktp_image->move(public_path('employees/ktps'), $ktpImageName);
            $data['ktp_image'] = $ktpImageName;
        }

        // BPJS TK
        if ($request->hasFile('bpjs_tk_card')) {
            $npwpImageName = time() . '-' . $data['nip'] . '.' . $request->bpjs_tk_card->getClientOriginalExtension();
            $request->bpjs_tk_card->move(public_path('employees/bpjstks'), $npwpImageName);
            $data['bpjs_tk_card'] = $npwpImageName;
        }

        // BPJS Health
        if ($request->hasFile('bpjs_health_card')) {
            $npwpImageName = time() . '-' . $data['nip'] . '.' . $request->bpjs_health_card->getClientOriginalExtension();
            $request->bpjs_health_card->move(public_path('employees/bpjshealthes'), $npwpImageName);
            $data['bpjs_health_card'] = $npwpImageName;
        }

        $employee = Employee::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee Created Successfully',
            'data' => new EmployeeResource($employee)
        ]);
    }

    public function show(Employee $employee)
    {
        return response()->json([
            'data' => new EmployeeResource($employee)
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'nip' => 'required|string|max:20',
            'avatar' => 'nullable',
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'pin' => 'required|string|max:6',
            'branch_id' => 'required|exists:branches,id',
            'schedule_id' => 'required|exists:schedules,id',
            'ktp' => 'nullable|string|max:25',
            'ktp_image' => 'nullable',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:255',
            'domicile' => 'nullable|string|max:255',
            'address' => 'nullable',
            'employment_status' => 'required',
            'date_joined' => 'required|date',
            'end_date' => 'nullable|date',
            'bpjs_tk_number' => 'nullable',
            'bpjs_tk_card' => 'nullable',
            'bpjs_health_number' => 'nullable',
            'bpjs_health_card' => 'nullable',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'status' => 'nullable|boolean'
        ]);

        // Avatar
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '-' . $data['nip'] . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('employees/avatars'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        // KTP
        if ($request->hasFile('ktp_image')) {
            $ktpImageName = time() . '-' . $data['nip'] . '.' . $request->ktp_image->getClientOriginalExtension();
            $request->ktp_image->move(public_path('employees/ktps'), $ktpImageName);
            $data['ktp_image'] = $ktpImageName;
        }

        // BPJS TK
        if ($request->hasFile('bpjs_tk_card')) {
            $npwpImageName = time() . '-' . $data['nip'] . '.' . $request->bpjs_tk_card->getClientOriginalExtension();
            $request->bpjs_tk_card->move(public_path('employees/bpjstks'), $npwpImageName);
            $data['bpjs_tk_card'] = $npwpImageName;
        }

        // BPJS Health
        if ($request->hasFile('bpjs_health_card')) {
            $npwpImageName = time() . '-' . $data['nip'] . '.' . $request->bpjs_health_card->getClientOriginalExtension();
            $request->bpjs_health_card->move(public_path('employees/bpjshealthes'), $npwpImageName);
            $data['bpjs_health_card'] = $npwpImageName;
        }

        $employee->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Employee Edited Successfully',
            'data' => new EmployeeResource($employee)
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Employee Deleted Successfully'
        ]);
    }
}
