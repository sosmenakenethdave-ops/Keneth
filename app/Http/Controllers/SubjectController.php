<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        // I-sort ang subjects ayon sa course, year, semester, at code para malinis ang pag-group sa view
        $subjects = Subject::orderBy('course')
            ->orderBy('year')
            ->orderBy('semester')
            ->orderBy('code')
            ->get();
        
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:subjects,code',
            'title' => 'required',
            'units' => 'required|integer',
            'course' => 'required|in:IT,CS',
            'year' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:2',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'code' => 'required|unique:subjects,code,' . $subject->id,
            'title' => 'required',
            'units' => 'required|integer',
            'course' => 'required|in:IT,CS',
            'year' => 'required|integer|min:1|max:4',
            'semester' => 'required|integer|min:1|max:2',
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}