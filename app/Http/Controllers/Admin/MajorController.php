<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::withCount('registrations')->get();
        return view('admin.majors.index', compact('majors'));
    }
    
    public function create()
    {
        return view('admin.majors.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:majors',
            'description' => 'nullable|string',
            'quota' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('majors', 'public');
        }
        
        Major::create($data);
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }
    
    public function edit(Major $major)
    {
        return view('admin.majors.edit', compact('major'));
    }
    
    public function update(Request $request, Major $major)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:majors,code,'.$major->id,
            'description' => 'nullable|string',
            'quota' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($major->image) Storage::delete($major->image);
            $data['image'] = $request->file('image')->store('majors', 'public');
        }
        
        $major->update($data);
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diupdate.');
    }
    
    public function destroy(Major $major)
    {
        if ($major->image) Storage::delete($major->image);
        $major->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan dihapus.');
    }
    
    public function updateQuota(Request $request, Major $major)
    {
        $request->validate(['quota' => 'required|integer|min:1']);
        $major->update(['quota' => $request->quota]);
        return redirect()->back()->with('success', 'Kuota diperbarui.');
    }
    
    public function stats()
    {
        $stats = Major::withCount('registrations')->get();
        return view('admin.majors.stats', compact('stats'));
    }
}