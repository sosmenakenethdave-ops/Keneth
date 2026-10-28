<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Siguraduhing student lang ang makaka-access
        if ($user->role !== 'student') {
            return redirect()->route('dashboard'); // o kung saan mang redirect based on role
        }

        // 1. Kunin ang kurso, year level, at semester ng student
        $rawCourse = $user->course ?? 'IT'; 
        $studentProgram = (str_contains(strtoupper($rawCourse), 'IT')) ? 'IT' : 'CS';
        
        // Halimbawa: $user->year_level ay integer (1, 2, 3, 4) o string ('3')
        $studentYear = $user->year_level ?? 3;      
        $studentSemester = $user->semester ?? 1;   // Default semester para sa active toggle tab

        $studentSection = $user->section ?? '3A';

        // 2. Kunin ang LAHAT ng subjects para sa kanilang Year Level (PAREHONG 1st at 2nd Semester)
        // para gumana nang maayos ang pag-toggle ng 1st / 2nd Semester buttons sa UI
        $subjects = Subject::where('course', $studentProgram)
            ->where('year', $studentYear)
            ->with(['schedule.room', 'schedule.instructor']) // Eager load para makuha ang kumpletong schedule details
            ->orderBy('semester')
            ->orderBy('code')
            ->get();

        // 3. Kunin ang BUONG 4-year curriculum/subjects para naman sa Curriculum Modal
        $allCurriculumSubjects = Subject::where('course', $studentProgram)
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get();

        // 4. Kwentuhin ang total units (pwedeng i-base sa default semester o sa kabuuan)
        $totalUnits = $subjects->where('semester', $studentSemester)->sum('units');

        return view('student.dashboard', compact(
            'subjects', 
            'allCurriculumSubjects', 
            'studentProgram', 
            'studentYear', 
            'studentSemester', 
            'studentSection', 
            'totalUnits'
        ));
    }
}