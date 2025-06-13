<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::forUser()
            ->with('project')
            ->orderByDueDate()
            ->paginate(15);
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $projects = Project::forUser()->get();
        $selectedProjectId = $request->query('project_id');
        
        return view('tasks.create', compact('projects', 'selectedProjectId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'project_id' => 'required|exists:projects,id',
            'due_date' => 'nullable|date',
            'estimated_hours' => 'nullable|integer|min:0',
            'priority' => 'required|integer|between:0,2',
            'group' => 'nullable|string|max:100',
            'labels' => 'nullable|array'
        ]);

        $task = Task::create($validated);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::forUser()
            ->with('project')
            ->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::forUser()->findOrFail($id);
        $projects = Project::forUser()->get();

        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::forUser()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,in_progress,done',
            'project_id' => 'required|exists:projects,id',
            'due_date' => 'nullable|date',
            'estimated_hours' => 'nullable|integer|min:0',
            'priority' => 'required|integer|between:0,2',
            'group' => 'nullable|string|max:100',
            'labels' => 'nullable|array'
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::forUser()->findOrFail($id);
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
