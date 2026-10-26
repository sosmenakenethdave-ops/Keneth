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
        // Sinigurong kasama ang relations at naka-group o order kung kinakailangan
        $schedules = Schedule::with(['subject', 'room', 'instructor'])->latest()->paginate(10);
        
        // Pwede rin nating ipasa ang mga instructors o grouped data kung gagamitin sa view side filters
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        // I-group ang subjects ayon sa Course para sa organized dropdown selection
        $subjects = Subject::orderBy('course')
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get()
            ->groupBy('course');

        // I-group ang rooms ayon sa Building
        $rooms = Room::orderBy('building')
            ->orderBy('name')
            ->get()
            ->groupBy('building');

        // Kunin ang mga instructor at i-order ayon sa pangalan o rank
        $instructors = User::where('role', 'instructor')
            ->orderBy('academic_rank')
            ->orderBy('name')
            ->get();

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

        $day = $request->day;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $roomId = $request->room_id;
        $instructorId = $request->instructor_id;

        // 1. Room Conflict Detection Logic
        $roomConflict = Schedule::where('room_id', $roomId)
            ->where('day', $day)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })->exists();

        if ($roomConflict) {
            return back()->withErrors(['room_id' => '⚠️ Room Conflict: Ang napiling room ay may klase na sa araw at oras na ito!'])->withInput();
        }

        // 2. Instructor Conflict Detection Logic
        if ($instructorId) {
            $instructorConflict = Schedule::where('instructor_id', $instructorId)
                ->where('day', $day)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                          ->orWhereBetween('end_time', [$startTime, $endTime])
                          ->orWhere(function ($q) use ($startTime, $endTime) {
                              $q->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                          });
                })->exists();

            if ($instructorConflict) {
                return back()->withErrors(['instructor_id' => '⚠️ Instructor Conflict: May iba nang klase ang instructor na ito sa kaparehong oras!'])->withInput();
            }
        }

        Schedule::create($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Matagumpay na naidagdag ang schedule nang walang conflict.');
    }

    public function edit(Schedule $schedule)
    {
        $subjects = Subject::orderBy('course')
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get()
            ->groupBy('course');

        $rooms = Room::orderBy('building')
            ->orderBy('name')
            ->get()
            ->groupBy('building');

        $instructors = User::where('role', 'instructor')
            ->orderBy('academic_rank')
            ->orderBy('name')
            ->get();

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

        $day = $request->day;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $roomId = $request->room_id;
        $instructorId = $request->instructor_id;

        // 1. Room Conflict Detection (Excluding current schedule)
        $roomConflict = Schedule::where('id', '!=', $schedule->id)
            ->where('room_id', $roomId)
            ->where('day', $day)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })->exists();

        if ($roomConflict) {
            return back()->withErrors(['room_id' => '⚠️ Room Conflict: Ang napiling room ay ginagamit na sa oras na ito!'])->withInput();
        }

        // 2. Instructor Conflict Detection (Excluding current schedule)
        if ($instructorId) {
            $instructorConflict = Schedule::where('id', '!=', $schedule->id)
                ->where('instructor_id', $instructorId)
                ->where('day', $day)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                          ->orWhereBetween('end_time', [$startTime, $endTime])
                          ->orWhere(function ($q) use ($startTime, $endTime) {
                              $q->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                          });
                })->exists();

            if ($instructorConflict) {
                return back()->withErrors(['instructor_id' => '⚠️ Instructor Conflict: May klase na ang instructor sa oras na ito!'])->withInput();
            }
        }

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')->with('success', 'Matagumpay na na-update ang schedule.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Matagumpay na na-delete ang schedule.');
    }
}