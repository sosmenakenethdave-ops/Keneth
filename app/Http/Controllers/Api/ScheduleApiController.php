<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/schedules
     */
    public function index()
    {
        $schedules = Schedule::with(['subject', 'instructor', 'room'])->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Schedules retrieved successfully.',
            'data' => $schedules
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/schedules
     */
    public function store(Request $request)
    {
        // 1. Validation para matiyak na kompleto at wasto ang data
        $validator = Validator::make($request->all(), [
            'subject_id'    => 'required|exists:subjects,id',
            'instructor_id' => 'required|exists:users,id',
            'room_id'       => 'required|exists:rooms,id',
            'day'           => 'required|string',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors found.',
                'errors'  => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }

        // 2. Pag-save ng bagong schedule sa database
        $schedule = Schedule::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Schedule created successfully.',
            'data'    => $schedule->load(['subject', 'instructor', 'room'])
        ], 201); // 201 Created
    }

    /**
     * Display the specified resource.
     * GET /api/schedules/{id}
     */
    public function show($id)
    {
        $schedule = Schedule::with(['subject', 'instructor', 'room'])->find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule record not found.'
            ], 404); // 404 Not Found
        }

        return response()->json([
            'success' => true,
            'message' => 'Schedule retrieved successfully.',
            'data'    => $schedule
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH /api/schedules/{id}
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule record not found.'
            ], 404);
        }

        // Validation para sa pag-update (gumamit ng 'sometimes' kung partial updates)
        $validator = Validator::make($request->all(), [
            'subject_id'    => 'sometimes|required|exists:subjects,id',
            'instructor_id' => 'sometimes|required|exists:users,id',
            'room_id'       => 'sometimes|required|exists:rooms,id',
            'day'           => 'sometimes|required|string',
            'start_time'    => 'sometimes|required|date_format:H:i',
            'end_time'      => 'sometimes|required|date_format:H:i|after:start_time',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors found.',
                'errors'  => $validator->errors()
            ], 422);
        }

        $schedule->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Schedule updated successfully.',
            'data'    => $schedule->load(['subject', 'instructor', 'room'])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/schedules/{id}
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return response()->json([
                'success' => false,
                'message' => 'Schedule record not found.'
            ], 404);
        }

        $schedule->delete();

        return response()->json([
            'success' => true,
            'message' => 'Schedule deleted successfully.'
        ], 200);
    }
}