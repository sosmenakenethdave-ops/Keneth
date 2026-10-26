<?php

use App\Http\Controllers\Api\ScheduleApiController;

// Schedule API Routes na may CRUD operations
Route::apiResource('schedules', ScheduleApiController::class);