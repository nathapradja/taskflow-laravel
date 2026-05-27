<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request, Project $project)
    {
        $query = $project->tasks();

        if ($request->status) {

            $query->where('status', $request->status);

        }

        $tasks = $query->latest()->paginate(5);

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'nullable',
                'status' => 'required',
                'priority' => 'required',
                'due_date' => 'nullable|date',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            ]
        );

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {

            $attachmentPath = $request->file('attachment')
                ->store('attachments', 'public');

        }

        $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'attachment' => $attachmentPath,
        ]);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task berhasil dibuat.');
    }

    public function show(Project $project, Task $task)
    {
        //
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'nullable',
                'status' => 'required',
                'priority' => 'required',
                'due_date' => 'nullable|date',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
            ]
        );

        $attachmentPath = $task->attachment;

        if ($request->hasFile('attachment')) {

            if ($task->attachment) {

                Storage::disk('public')
                    ->delete($task->attachment);

            }

            $attachmentPath = $request->file('attachment')
                ->store('attachments', 'public');

        }

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'attachment' => $attachmentPath,
        ]);

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task berhasil diupdate.');
    }

    public function destroy(Project $project, Task $task)
    {
        if ($task->attachment) {

            Storage::disk('public')
                ->delete($task->attachment);

        }

        $task->delete();

        return redirect()
            ->route('projects.tasks.index', $project)
            ->with('success', 'Task berhasil dihapus.');
    }
}