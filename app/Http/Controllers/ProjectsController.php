<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->accessibleProjects();
    
        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('manage', $project);

        return view('projects.show', compact('project'));
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'notes' => 'nullable'
        ]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $project = auth()->user()->projects()->create($this->validateRequest());

        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('manage', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('administer', $project);

        $project->delete();

        return redirect('/projects');
    }
}
