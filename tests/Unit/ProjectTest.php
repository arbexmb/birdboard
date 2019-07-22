<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_has_a_path()
    {
        $project = factory('App\Project')->create();

        $this->assertEquals('/projects/'. $project->id, $project->path());
    }

    /** @test */
    public function a_project_belongs_to_an_owner()
    {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf('App\User', $project->owner);
    }

    /** @test */
    public function a_project_can_add_a_task()
    {
        $project = factory('App\Project')->create();

        $task = $project->addTask('Test task body');

        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));
    }

    /** @test */
    public function it_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $project->invite($user = factory('App\User')->create());

        $this->assertTrue($project->members->contains($user));
    }
}
