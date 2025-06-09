<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Tag;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'desc')->get();
        return view('ideas.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('ideas.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'problem' => 'nullable|string',
            'audience' => 'nullable|string',
            'possible_solution' => 'nullable|string',
            'is_ready' => 'boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'new_tags' => 'nullable|string',
        ]); 

        // Handle is_ready checkbox
        $validated['is_ready'] = $request->has('is_ready');

        $idea = Idea::create($validated);

        // Handle tags
        $tagIds = $validated['tags'] ?? [];
        if (!empty($validated['new_tags'])) {
            $newTagNames = array_filter(array_map('trim', explode(',', $validated['new_tags'])));
            foreach ($newTagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        if (!empty($tagIds)) {
            $idea->tags()->attach($tagIds);
        }

        return redirect()->route('ideas.index')->with('success', 'Idea added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $idea = Idea::with('tags')->findOrFail($id);
        return view('ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
