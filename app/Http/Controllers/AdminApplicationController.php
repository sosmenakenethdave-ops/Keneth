<?php

namespace App\Http\Controllers;

use App\Models\AdminApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class AdminApplicationController extends Controller
{
    /**
     * Show the public form to apply for Administrator.
     */
    public function create()
    {
        return view('auth.apply-admin');
    }

    /**
     * Store the submitted application with required documents and credentials.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'unique:admin_applications,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'position_applied' => ['required', 'string', 'max:255'],
            'requirements' => ['required', 'file', 'mimes:pdf,zip,rar,doc,docx', 'max:10240'], // Max 10MB
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        // Save uploaded requirement file
        $filePath = null;
        if ($request->hasFile('requirements')) {
            $filePath = $request->file('requirements')->store('admin_requirements', 'public');
        }

        AdminApplication::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password upon submission
            'phone' => $request->phone,
            'position_applied' => $request->position_applied,
            'requirements_path' => $filePath,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('admin.apply')
            ->with('status', 'Your application for Administrator has been submitted successfully! Please wait for review.');
    }

    /**
     * List all applications for review (Admin View).
     */
    public function index()
    {
        $applications = AdminApplication::latest()->paginate(10);

        return view('admin.applications.index', compact('applications'));
    }

    /**
     * View details of a specific application.
     */
    public function show(AdminApplication $application)
    {
        return view('admin.applications.show', compact('application'));
    }

    /**
     * Approve an application and create the Admin user account.
     */
    public function approve(AdminApplication $application)
    {
        if ($application->status !== 'pending') {
            return back()->with('error', 'This application has already been processed.');
        }

        // Create the Admin User Account using the password set during application
        User::create([
            'name' => $application->name,
            'email' => $application->email,
            'password' => $application->password, // Transfer the hashed password
            'role' => 'admin',
        ]);

        // Update Application Status
        $application->update([
            'status' => 'approved',
        ]);

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application approved successfully! The user can now log in using the credentials they provided during application.');
    }

    /**
     * Reject an application.
     */
    public function reject(Request $request, AdminApplication $application)
    {
        $request->validate([
            'rejection_reason' => ['nullable', 'string', 'max:500'],
        ]);

        $application->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application has been rejected.');
    }
}