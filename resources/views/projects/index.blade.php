@extends('layouts.app')

@section('content')

    <header class="flex items-end mb-3 py-3">
        <p class="mr-auto text-sm text-gray-500">My Projects</p>
        <a href="/projects/create" class="button" @click.prevent="$modal.show('new-project')">Add Project</a>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-2">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-2 mb-4">
                @include('projects.card')
            </div>
        @empty
            <p>No projects yet.</p>
        @endforelse
    </main>

    <new-project-modal></new-project-modal>
@endsection