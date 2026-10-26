<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
// use App\Models\Schedule;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function adminDashboard(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            return $this->redirectBasedOnRole($user->role);
        }

        // Kunin ang mga subjects para sa IT at CS mula sa Database
        $itSubjects = Subject::where('course', 'IT')
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get();

        $csSubjects = Subject::where('course', 'CS')
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get();

        return view('admin.dashboard', compact('itSubjects', 'csSubjects'));
    }

    /**
     * Instructor Dashboard
     */
    public function instructorDashboard(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'instructor') {
            return $this->redirectBasedOnRole($user->role);
        }

        // TODO: Kunin ang mga assigned classes/schedules ng instructor na ito mula sa database
        $instructorSchedules = []; // Pansamantalang empty array

        return view('instructor.dashboard', compact('instructorSchedules'));
    }

    /**
     * Student Dashboard
     */
    public function studentDashboard(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'student') {
            return $this->redirectBasedOnRole($user->role);
        }

        // TODO: Kunin ang fixed semester schedule ng student na ito mula sa database
        $studentSchedules = []; // Pansamantalang empty array

        return view('student.dashboard', compact('studentSchedules'));
    }

    /**
     * Helper function para sa tamang pag-redirect batay sa role
     */
    private function redirectBasedOnRole($role)
    {
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }
        return redirect()->route('student.dashboard');
    }
}