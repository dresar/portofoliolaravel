<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:projects,slug',
            'description' => 'required',
            'short_description' => 'nullable',
            'category' => 'required|max:255',
            'technologies' => 'nullable|string',
            'client_name' => 'nullable|max:255',
            'project_date' => 'nullable|date',
            'url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'challenges' => 'nullable',
            'solution' => 'nullable',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if (!empty($validated['technologies'])) {
            $validated['technologies'] = json_encode(array_map('trim', explode(',', $validated['technologies'])));
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil ditambahkan.',
            'redirect' => route('admin.projects.index'),
        ]);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:projects,slug,' . $project->id,
            'description' => 'required',
            'short_description' => 'nullable',
            'category' => 'required|max:255',
            'technologies' => 'nullable|string',
            'client_name' => 'nullable|max:255',
            'project_date' => 'nullable|date',
            'url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'challenges' => 'nullable',
            'solution' => 'nullable',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        if (!empty($validated['technologies'])) {
            $validated['technologies'] = json_encode(array_map('trim', explode(',', $validated['technologies'])));
        }

        if ($request->hasFile('image')) {
            if ($project->image) {
                \Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil diupdate.',
            'redirect' => route('admin.projects.index'),
        ]);
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            \Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dihapus.',
        ]);
    }
}

