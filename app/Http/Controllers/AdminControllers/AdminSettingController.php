<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSettingController extends Controller
{
    public function edit()
    {
        return view('admin_dashboard.about.edit', [
            'setting' => Setting::find(1)
        ]);
    }

    public function update()
    {
        $validated = request()->validate([
            'about_first_text' => 'required|min:5,max:500',
            'about_second_text' => 'required|min:5,max:500',
            'about_our_vision' => 'required',
            'about_our_mission' => 'required',
            'about_services' => 'required',
            'about_first_image' => 'nullable|image',
            'about_second_image' => 'nullable|image',
        ]);
        Setting::find(1)->update($validated);
        return redirect()->route('admin.setting.edit')->with('success', 'Setting has been Updated');
    }
}
