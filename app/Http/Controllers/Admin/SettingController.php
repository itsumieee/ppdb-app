<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }
    
    public function update(Request $request)
    {
        $keys = ['school_name', 'logo', 'favicon', 'banner', 'theme_color', 'ppdb_info'];
        
        foreach ($keys as $key) {
            if ($request->hasFile($key)) {
                // upload file
                $old = Setting::where('key', $key)->first();
                if ($old && $old->value) Storage::delete($old->value);
                $path = $request->file($key)->store('settings', 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            } elseif ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->$key]);
            }
        }
        
        return redirect()->route('admin.pengaturan.index')->with('success', 'Pengaturan disimpan.');
    }
}