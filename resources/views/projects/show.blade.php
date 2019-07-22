@extends('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-3">
        <div class="flex justify-between items-end w-full">
            <p class="mr-auto text-sm text-gray-500">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>
            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}" 
                        alt="{{ $member->name }}'s avatar" 
                        class="avatar-picture" 
                        style="max-width:40px;" />
                @endforeach
                <img 
                    src="{{ gravatar_url($project->owner->email) }}" 
                    alt="{{ $project->owner->name }}'s avatar" 
                    class="avatar-picture" 
                    style="max-width:40px;" />
                <a href="{{ $project->path() . '/edit' }}" class="button ml-3">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-2">
            <div class="lg:w-2/3 px-2">
                <div class="mb-6">
                    <h2 class="text-gray-500 font-normal text-lg mb-2">Tasks</h2>
                    @foreach($project->tasks as $task)
                        <div class="task-card">
                            <form action="{{ $task->path() }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="flex items-center">
                                    <input type="text" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-green-500' : '' }}" name="body" />
                                    <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }} />
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="task-card">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf
                            <input type="text" class="w-full" placeholder="Add a new task..." name="body" />
                        </form>
                    </div>
                    <p class="font-bold">No tasks assigned to this project yet!</p>
                </div>
                <div>
                    <h2 class="text-gray-500 font-normal text-lg mb-2">General Notes</h2>
                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea
                            class="card w-full p-4 mb-3"
                            rows="6"
                            name="notes"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>
                        <button type="submit" class="button">Save</button>
                    </form>
                    @include('errors')
                </div>
            </div>
            <div class="lg:w-1/3 mt-6 lg:mt-0 px-2">
                @include('projects.card')
                @include('projects.activity.card')

                @can('administer', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>

@endsection