<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Models\Employee\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\ScheduleResource;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::latest()->get();

        return ScheduleResource::collection($schedules);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50|unique:schedules,name',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s'
        ]);

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
            'name' => 'required|string|max:50|unique:schedules,name',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s'
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
