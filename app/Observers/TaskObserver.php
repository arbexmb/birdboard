<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    public function created(Task $task)
    {
        $task->project->recordActivity('created_task');
    }

    public function updated(Task $task)
    {
        if(! $task->completed) return;
        
        $task->project->recordActivity('completed_task');
    }
}
