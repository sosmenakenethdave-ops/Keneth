<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['subject', 'room', 'instructor'])->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $rooms = Room::all();
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.schedules.create', compact('subjects', 'rooms', 'instructors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'room_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        // Conflict Check 1: Room Conflict Detection
        $roomConflict = Schedule::where('room_id', $request->room_id)
            ->where('day', $request->day)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($roomConflict) {
            return back()->withErrors(['room_id' => 'Conflict Detected: High-level conflict! Ang napiling Room ay nakareserba na sa oras na ito.'])->withInput();
        }

        // Conflict Check 2: Instructor Conflict Detection
        if ($request->instructor_id) {
            $instructorConflict = Schedule::where('instructor_id', $request->instructor_id)
                ->where('day', $request->day)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                        ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
                })->exists();

            if ($instructorConflict) {
                return back()->withErrors(['instructor_id' => 'Conflict Detected: May klase na ang Instructors sa kaparehong oras!'])->withInput();
            }
        }

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $subjects = Subject::all();
        $rooms = Room::all();
        $instructors = User::where('role', 'instructor')->get();
        return view('admin.schedules.edit', compact('schedule', 'subjects', 'rooms', 'instructors'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'subject_id' => 'required',
            'room_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}