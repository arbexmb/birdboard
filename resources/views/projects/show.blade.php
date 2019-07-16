@extends('layouts.app')

@section('content')

    <header class="flex items-end mb-3 py-3">
        <p class="mr-auto text-sm text-gray-500">
            <a href="/projects">My Projects</a> / {{ $project->title }}
        </p>
        <a href="/projects/create" class="bg-blue-500 hover:bg-blue-700 text-white font-normal py-2 px-4 rounded">Add Project</a>
    </header>

    <main>
        <div class="lg:flex -mx-2">
            <div class="lg:w-2/3 px-2">
                <div class="mb-6">
                    <h2 class="text-gray-500 font-normal text-lg mb-2">Tasks</h2>
                    @forelse($project->tasks as $task)
                        <div class="task-card">{{ $task->body }}</div>
                    @empty
                        <p class="font-bold">No tasks assigned to this project yet!</p>
                    @endforelse
                </div>
                <div>
                    <h2 class="text-gray-500 font-normal text-lg mb-2">General Notes</h2>
                    <textarea class="card w-full" rows="6">Lorem ipsum.</textarea>
                </div>
            </div>
            <div class="lg:w-1/3 mt-6 lg:mt-0 px-2">
                @include('projects.card')
            </div>
        </div>
    </main>

@endsection