<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use App\Models\Main\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Models\Employee\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Employee\AttendanceResource;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->latest()->get();

        return AttendanceResource::collection($attendances);
    }

    public function branch(Branch $branch)
    {
        $attendances = Attendance::where('branch_id', $branch->id)->latest()->get();

        return AttendanceResource::collection($attendances);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'entry_time' => 'required|date_format:H:i',
            'entry_location' => 'required|string|max:255',
            'entry_photo' => 'nullable|image|max:2048',
            'late_reason' => 'nullable|string|max:1000',
            'exit_time' => 'nullable|date_format:H:i',
            'exit_location' => 'nullable|string|max:255',
            'exit_photo' => 'nullable|image|max:2048',
            'early_leave_reason' => 'nullable|string|max:1000',
            'status' => 'required|in:valid,invalid,pending',
            'verified_by' => 'nullable|exists:employees,id'
        ]);
        $data['user_id'] = Auth::id();

        // Get data employee & schedule
        $employee = Employee::with('schedule')->findOrFail($data['employee_id']);
        $schedule = $employee->schedule;
        if (!$schedule) {
            return response()->json([
                'message' => 'Schedule not found for this employee.'
            ], 422);
        }

        // Branch
        $data['branch'] = $employee->branch->id;

        // Entry Photo
        if ($request->hasFile('entry_photo')) {
            $entryPhotoName = 'IMG' . time() . '-' . 'entry-' .  Str::slug($employee->name) . '.' . $request->entry_photo->getClientOriginalExtension();
            $request->entry_photo->move(public_path('attendances/entry-photos'), $entryPhotoName);
            $data['entry_photo'] = $entryPhotoName;
        }

        // Exit Photo
        if ($request->hasFile('exit_photo')) {
            $exitPhotoName = 'IMG' . time() . '-' . 'exit-' .  Str::slug($employee->name) . '.' . $request->exit_photo->getClientOriginalExtension();
            $request->exit_photo->move(public_path('attendances/exit-photos'), $exitPhotoName);
            $data['exit_photo'] = $exitPhotoName;
        }

        $scheduledStart = Carbon::createFromFormat('H:i:s', $schedule->start_time);
        $scheduledEnd = Carbon::createFromFormat('H:i:s', $schedule->end_time);
        $entryTime = Carbon::createFromFormat('H:i:s', $data['entry_time']);

        // entry_status & late_minutes
        if ($entryTime->lessThanOrEqualTo($scheduledStart)) {
            $data['entry_status'] = 'on_time';
            $data['late_minutes'] = null;
        } else {
            $data['entry_status'] = 'late';
            $data['late_minutes'] = $entryTime->diffInMinutes($scheduledStart);
        }

        // exit_status & early_leave_minutes
        if (!empty($data['exit_time'])) {
            $exitTime = Carbon::createFromFormat('H:i:s', $data['exit_time']);

            if ($exitTime->greaterThanOrEqualTo($scheduledEnd)) {
                $data['exit_status'] = 'on_time';
                $data['early_leave_minutes'] = null;
            } else {
                $data['exit_status'] = 'early_leave';
                $data['early_leave_minutes'] = $scheduledEnd->diffInMinutes($exitTime);
            }
        } else {
            $data['exit_status'] = null;
            $data['early_leave_minutes'] = null;
        }

        $attendance = Attendance::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Created Successfully',
            'data' => new AttendanceResource($attendance)
        ]);
    }

    public function show(Attendance $attendance)
    {
        return response()->json([
            'data' => new AttendanceResource($attendance)
        ]);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'branch_id' => 'required|exists:branches,id',
            'date' => 'required|date',
            'entry_time' => 'required|date_format:H:i',
            'entry_location' => 'required|string|max:255',
            'entry_photo' => 'nullable|image|max:2048',
            'late_reason' => 'nullable|string|max:1000',
            'exit_time' => 'nullable|date_format:H:i',
            'exit_location' => 'nullable|string|max:255',
            'exit_photo' => 'nullable|image|max:2048',
            'early_leave_reason' => 'nullable|string|max:1000',
            'status' => 'required|in:valid,invalid,pending',
            'verified_by' => 'nullable|exists:employees,id'
        ]);

        // Get data employee & schedule
        $employee = Employee::with('schedule')->findOrFail($data['employee_id']);
        $schedule = $employee->schedule;
        if (!$schedule) {
            return response()->json([
                'message' => 'Schedule not found for this employee.'
            ], 422);
        }

        // Branch
        $data['branch'] = $employee->branch->id;

        // Entry Photo
        if ($request->hasFile('entry_photo')) {
            if ($attendance->entry_photo && file_exists(public_path('attendances/entry-photos/' . $attendance->entry_photo))) {
                unlink(public_path('attendances/entry-photos/' . $attendance->entry_photo));
            }
            $entryPhotoName = 'IMG' . time() . '-' . 'entry-' . Str::slug($employee->name) . '.' . $request->entry_photo->getClientOriginalExtension();
            $request->entry_photo->move(public_path('attendances/entry-photos'), $entryPhotoName);
            $data['entry_photo'] = $entryPhotoName;
        }

        // Exit Photo
        if ($request->hasFile('exit_photo')) {
            if ($attendance->exit_photo && file_exists(public_path('attendances/exit-photos/' . $attendance->exit_photo))) {
                unlink(public_path('attendances/exit-photos/' . $attendance->exit_photo));
            }
            $exitPhotoName = 'IMG' . time() . '-' . 'exit-' . Str::slug($employee->name) . '.' . $request->exit_photo->getClientOriginalExtension();
            $request->exit_photo->move(public_path('attendances/exit-photos'), $exitPhotoName);
            $data['exit_photo'] = $exitPhotoName;
        }

        $scheduledStart = Carbon::createFromFormat('H:i:s', $schedule->start_time);
        $scheduledEnd = Carbon::createFromFormat('H:i:s', $schedule->end_time);
        $entryTime = Carbon::createFromFormat('H:i:s', $data['entry_time']);

        // entry_status & late_minutes
        if ($entryTime->lessThanOrEqualTo($scheduledStart)) {
            $data['entry_status'] = 'on_time';
            $data['late_minutes'] = null;
        } else {
            $data['entry_status'] = 'late';
            $data['late_minutes'] = $entryTime->diffInMinutes($scheduledStart);
        }

        // exit_status & early_leave_minutes
        if (!empty($data['exit_time'])) {
            $exitTime = Carbon::createFromFormat('H:i:s', $data['exit_time']);

            if ($exitTime->greaterThanOrEqualTo($scheduledEnd)) {
                $data['exit_status'] = 'on_time';
                $data['early_leave_minutes'] = null;
            } else {
                $data['exit_status'] = 'early_leave';
                $data['early_leave_minutes'] = $scheduledEnd->diffInMinutes($exitTime);
            }
        } else {
            $data['exit_status'] = null;
            $data['early_leave_minutes'] = null;
        }

        $attendance->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Edited Successfully',
            'data' => new AttendanceResource($attendance)
        ]);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance Deleted Successfully'
        ]);
    }
}
