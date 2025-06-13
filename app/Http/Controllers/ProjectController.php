<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Idea;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::forUser()
            ->with(['idea', 'tasks', 'tags'])
            ->latest()
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ideas = Idea::forUser()
            ->where('is_ready', true)
            ->doesntHave('projects')
            ->get();

        return view('projects.create', compact('ideas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'idea_id' => 'nullable|exists:ideas,id',
            'features' => 'nullable|array',
            'status' => 'required|in:todo,in_progress,done'
        ]);

        $project = Project::create($validated);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::forUser()
            ->with(['idea', 'tasks', 'tags'])
            ->findOrFail($id);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::forUser()->findOrFail($id);
        $ideas = Idea::forUser()
            ->where('is_ready', true)
            ->where(function ($query) use ($project) {
                $query->doesntHave('projects')
                    ->orWhereHas('projects', function ($q) use ($project) {
                        $q->where('id', $project->id);
                    });
            })
            ->get();

        return view('projects.edit', compact('project', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::forUser()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'idea_id' => 'nullable|exists:ideas,id',
            'features' => 'nullable|array',
            'status' => 'required|in:todo,in_progress,done'
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::forUser()->findOrFail($id);
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Add a feature to the project.
     */
    public function addFeature(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $features = $project->features ?? [];
        $features[] = $validated;
        
        $project->update(['features' => $features]);

        return back()->with('success', 'Feature added successfully.');
    }

    /**
     * Remove a feature from the project.
     */
    public function removeFeature(Project $project, $featureIndex)
    {
        $this->authorize('update', $project);

        $features = $project->features ?? [];
        
        if (isset($features[$featureIndex])) {
            unset($features[$featureIndex]);
            $features = array_values($features); // Reset array keys
            
            $project->update(['features' => $features]);
            return back()->with('success', 'Feature removed successfully.');
        }

        return back()->with('error', 'Feature not found.');
    }
}
