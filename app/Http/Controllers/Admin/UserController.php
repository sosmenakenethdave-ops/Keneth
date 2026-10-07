<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // I-display ang listahan ng Students, Instructors, o Admins
    public function index(Request $request)
    {
        $role = $request->query('role', 'student'); // Default ay student
        
        if (!in_array($role, ['student', 'instructor', 'admin'])) {
            $role = 'student';
        }

        // Query Builder na may Search at Role Filter
        $query = User::where('role', $role);

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Pagination (10 per page) kasama ang query parameters
        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users', 'role'));
    }

    // Form para mag-create ng bagong user
    public function create(Request $request)
    {
        $role = $request->query('role', 'student');
        return view('admin.users.create', compact('role'));
    }

    // I-save ang bagong user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'instructor', 'student'])],
            'course' => 'nullable|string|max:255',
            'year_level' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'academic_rank' => 'nullable|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'active',
            'course' => $request->course,
            'year_level' => $request->year_level,
            'section' => $request->section,
            'academic_rank' => $request->academic_rank,
        ]);

        return redirect()->route('admin.users.index', ['role' => $request->role])
                         ->with('success', 'User created successfully.');
    }

    // Form para i-edit ang user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Update user details
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => ['required', Rule::in(['admin', 'instructor', 'student'])],
            'password' => 'nullable|string|min:8',
            'course' => 'nullable|string|max:255',
            'year_level' => 'nullable|string|max:255',
            'section' => 'nullable|string|max:255',
            'academic_rank' => 'nullable|string|max:255',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'course' => $request->role === 'student' ? $request->course : null,
            'year_level' => $request->role === 'student' ? $request->year_level : null,
            'section' => $request->role === 'student' ? $request->section : null,
            'academic_rank' => $request->role === 'instructor' ? $request->academic_rank : null,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.users.index', ['role' => $user->role])
                         ->with('success', 'User updated successfully.');
    }

    // Toggle Status (Activate / Deactivate)
    public function toggleStatus(User $user)
    {
        // Security Check: Bawal i-deactivate ang sariling account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate your own account!');
        }

        $user->status = ($user->status === 'active') ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', "User account is now {$user->status}.");
    }

    // Delete User
    public function destroy(User $user)
    {
        // Security Check: Bawal i-delete ang sariling account
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        $role = $user->role;
        $user->delete();

        return redirect()->route('admin.users.index', ['role' => $role])
                         ->with('success', 'User deleted successfully.');
    }
}