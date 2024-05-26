<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;


class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::where('doctor_id', Auth::id())->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Schedule::create([
            'doctor_id' => Auth::id(),
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function getDoctorSchedules(Request $request)
    {
        $doctorId = Auth::id();

        $schedules = Schedule::with('doctor')
            ->where('doctor_id', $doctorId)
            ->get();

        return response()->json($schedules);
    }

    public function getAllDoctorSchedules(Request $request)
    {
        $schedules = Schedule::with('doctor')->get();

        return response()->json($schedules);
    }

    public function edit(Schedule $schedule)
{
    return view('schedules.edit', compact('schedule'));
}

public function update(Request $request, Schedule $schedule)
{
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    $schedule->update([
        'date' => $request->input('date'),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time'),
    ]);

    return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
}
}
