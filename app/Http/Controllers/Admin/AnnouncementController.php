<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }
    
    public function create()
    {
        return view('admin.announcements.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }
        
        Announcement::create($data);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman ditambahkan.');
    }
    
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }
    
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);
        
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($announcement->image) Storage::delete($announcement->image);
            $data['image'] = $request->file('image')->store('announcements', 'public');
        }
        
        $announcement->update($data);
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman diupdate.');
    }
    
    public function destroy(Announcement $announcement)
    {
        if ($announcement->image) Storage::delete($announcement->image);
        $announcement->delete();
        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman dihapus.');
    }
    
    public function togglePublish(Announcement $announcement)
    {
        $announcement->update([
            'is_published' => !$announcement->is_published,
            'published_at' => !$announcement->is_published ? now() : null
        ]);
        return redirect()->back()->with('success', 'Status publikasi diubah.');
    }
}