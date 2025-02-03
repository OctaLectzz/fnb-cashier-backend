<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::latest()->get();

        return SettingResource::collection($settings);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'logo' => 'required|image',
            'logo_size' => 'required|integer',
            'about' => 'required'
        ]);

        // Logo
        if ($request->hasFile('logo')) {
            $imageName = 'IMG' . time() . '-' . Str::slug($data['title']) . '-logo' . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('settings'), $imageName);
            $data['logo'] = $imageName;
        }

        $setting = Setting::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Setting Created Successfully',
            'data' => new SettingResource($setting)
        ]);
    }

    public function show(Setting $setting)
    {
        return response()->json([
            'data' => new SettingResource($setting)
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'logo' => 'required|image',
            'logo_size' => 'required|integer',
            'about' => 'required'
        ]);

        // Logo
        if ($request->hasFile('logo')) {
            $imageName = 'IMG' . time() . '-' . Str::slug($data['title']) . '-logo' . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('settings'), $imageName);
            $data['logo'] = $imageName;
        }

        $setting->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Setting Edited Successfully',
            'data' => new SettingResource($setting)
        ]);
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Setting Deleted Successfully'
        ]);
    }
}
