<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('manage', $project);

        request()->validate(['body' => 'required']);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('manage', $project);

        request()->validate(['body' => 'required']);

        $task->update(['body' => request('body')]);

        if(request()->has('completed'))
            $task->complete();

        return redirect($project->path());
    }
}