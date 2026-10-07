<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'room_id',
        'instructor_id',
        'day',
        'start_time',
        'end_time',
    ];

    /**
     * Relationship: Ang Schedule ay nakakabit sa isang Subject.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Relationship: Ang Schedule ay nakakabit sa isang Room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Relationship: Ang Schedule ay nakakabit sa isang Instructor (User model).
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}