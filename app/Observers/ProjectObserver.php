<?php

namespace App\Observers;

use App\Project;

class ProjectObserver
{
    public function created(Project $project)
    {
        $project->recordActivity('created_project');
    }

    public function updated(Project $project)
    {
        $project->recordActivity('updated_project');
    }
}
