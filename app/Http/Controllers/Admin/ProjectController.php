<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'tech_stack'  => 'required|string',
            'image_url'   => 'nullable|url',
            'github_url'  => 'nullable|url',
            'live_url'    => 'nullable|url',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
        ]);
        $validated['featured'] = $request->boolean('featured');
        Project::create($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string',
            'tech_stack'  => 'required|string',
            'image_url'   => 'nullable|url',
            'github_url'  => 'nullable|url',
            'live_url'    => 'nullable|url',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
        ]);
        $validated['featured'] = $request->boolean('featured');
        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }
}
