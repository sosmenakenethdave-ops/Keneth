<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class InstructorDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Kunin ang mga subjects o teaching loads na naka-assign sa instructor
        $instructorSubjects = Subject::with(['schedule.room', 'schedule.instructor'])->get();
        
        // Kunin ang lahat ng curriculum subjects at i-group ayon sa course/program (IT vs CS)
        $allCurriculumSubjects = Subject::orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get();

        $itSubjects = $allCurriculumSubjects->where('course', 'IT');
        $csSubjects = $allCurriculumSubjects->where('course', 'CS');

        return view('instructor.dashboard', [
            'instructorSubjects'    => $instructorSubjects,
            'allCurriculumSubjects' => $allCurriculumSubjects,
            'itSubjects'            => $itSubjects,
            'csSubjects'            => $csSubjects,
        ]);
    }
}