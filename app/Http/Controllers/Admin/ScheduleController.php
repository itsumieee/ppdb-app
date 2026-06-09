<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('start_date')->get();
        return view('admin.schedules.index', compact('schedules'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string'
        ]);
        
        Schedule::create($request->all());
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal ditambahkan.');
    }
    
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string'
        ]);
        
        $schedule->update($request->all());
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal diupdate.');
    }
    
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal dihapus.');
    }
}