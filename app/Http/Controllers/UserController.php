<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // READ: Display users based on role filter (default to student)
    public function index(Request $request)
    {
        $role = $request->get('role', 'student'); // Default role kung walang napili
        
        // Kunin ang mga users base sa role
        $users = User::where('role', $role)->paginate(10);

        return view('admin.users.index', compact('users', 'role'));
    }

    // CREATE: Show form to create user with role
    public function create(Request $request)
    {
        $role = $request->get('role', 'student');
        return view('admin.users.create', compact('role'));
    }

    // CREATE: Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:student,instructor,admin'],
            'academic_rank' => ['nullable', 'string'],
            'course' => ['nullable', 'string'],
            'year_level' => ['nullable', 'string'],
            'section' => ['nullable', 'string'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'academic_rank' => $request->academic_rank,
            'course' => $request->course,
            'year_level' => $request->year_level,
            'section' => $request->section,
        ]);

        return redirect()->route('admin.users.index', ['role' => $request->role])
                         ->with('success', 'Matagumpay na naidagdag ang bagong ' . $request->role . '!');
    }

    // UPDATE: Show form to edit user
    public function edit(User $user)
    {
        $role = $user->role;
        return view('admin.users.edit', compact('user', 'role'));
    }

    // UPDATE: Save updated user details
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:student,instructor,admin'],
            'academic_rank' => ['nullable', 'string'],
            'course' => ['nullable', 'string'],
            'year_level' => ['nullable', 'string'],
            'section' => ['nullable', 'string'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'academic_rank' => $request->academic_rank,
            'course' => $request->course,
            'year_level' => $request->year_level,
            'section' => $request->section,
        ];

        if ($request->filled('password')) {
            $request->validate([
                'password' => [Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index', ['role' => $user->role])
                         ->with('success', 'Matagumpay na na-update ang user!');
    }

    // DELETE: Remove user
    public function destroy(User $user)
    {
        $role = $user->role;
        $user->delete();
        
        return redirect()->route('admin.users.index', ['role' => $role])
                         ->with('success', 'Matagumpay na na-delete ang user!');
    }
}