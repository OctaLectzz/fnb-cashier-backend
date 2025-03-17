<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Models\Employee\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Employee\ScheduleResource;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('user_id', Auth::id())->latest()->get();

        return ScheduleResource::collection($schedules);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i'
        ]);
        $data['user_id'] = Auth::id();

        $schedule = Schedule::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule Created Successfully',
            'data' => new ScheduleResource($schedule)
        ]);
    }

    public function show(Schedule $schedule)
    {
        return response()->json([
            'data' => new ScheduleResource($schedule)
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i'
        ]);

        $schedule->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule Edited Successfully',
            'data' => new ScheduleResource($schedule)
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule Deleted Successfully'
        ]);
    }
}
