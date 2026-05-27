<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        if (auth()->user()->role !== 'admin') {

            $query->where('user_id', auth()->id());

        }

        if ($request->search) {

            $query->where(
                'title',
                'like',
                '%' . $request->search . '%'
            );

        }

        $projects = $query->latest()->paginate(5);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'nullable',
                'deadline' => 'nullable|date',
            ],
            [
                'title.required' => 'Title wajib diisi.',
                'title.max' => 'Title maksimal 255 karakter.',
                'deadline.date' => 'Deadline harus berupa tanggal.',
            ]
        );

        Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        if (
            auth()->user()->role !== 'admin'
            && $project->user_id !== auth()->id()
        ) {

            abort(403);

        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        if (
            auth()->user()->role !== 'admin'
            && $project->user_id !== auth()->id()
        ) {

            abort(403);

        }

        $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'nullable',
                'deadline' => 'nullable|date',
            ]
        );

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if (
            auth()->user()->role !== 'admin'
            && $project->user_id !== auth()->id()
        ) {

            abort(403);

        }

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}