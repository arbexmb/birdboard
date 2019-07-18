<?php

namespace Tests\Setup;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    public function create()
    {
        $project = factory('App\Project')->create([
            'owner_id' => $this->user ?? factory('App\User')
        ]);

        factory('App\Task', $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }

    public function withTasks($count = 1)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }
}