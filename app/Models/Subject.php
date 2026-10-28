<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'units',
        'year',
        'semester',
        'course',
    ];

    /**
     * Relasyon patungo sa Schedule model
     */
    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'subject_id'); // Palitan ang foreign key kung kinakailangan
    }
}