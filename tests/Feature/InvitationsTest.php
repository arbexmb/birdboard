<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Facades\Tests\Setup\ProjectFactory;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function non_owners_of_the_project_cannot_invite_users()
    {
        $project = ProjectFactory::create();

        $user = factory('App\User')->create();

        $assertInvitationForbidden = function () use ($user, $project) {
            $this->actingAs($user)
                ->post($project->path() . '/invite')
                ->assertStatus(403);
        };

        $assertInvitationForbidden();

        $project->invite($user);

        $assertInvitationForbidden();
    }

    /** @test */
    function a_project_owner_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $user = factory('App\User')->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invite', [
                'email' => $user->email
            ])
            ->assertRedirect($project->path());

        $this->assertTrue($project->members->contains($user));
    }

    /** @test */
    function a_project_owner_cannot_invite_himself_to_the_project()
    {
        $user = factory('App\User')->create();

        $project = ProjectFactory::ownedBy($user)->create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/invite', [
                'email' => $user->email
            ])
            ->assertStatus(403);
    }

    /** @test */
    function the_email_address_must_be_a_valid_birdboard_account()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)->post($project->path() . '/invite', [
            'email' => 'fakeemail@fakeemail.com.br'
        ])
        ->assertSessionHasErrors([
            'email' => 'The user you are inviting must have a Birdboard account.'
        ], null, 'invitations');
    }

    /** @test */
    public function invited_users_can_update_project_details()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = factory('App\User')->create());

        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo Task']);
        $this->assertDatabaseHas('tasks', $task);
    }
}
