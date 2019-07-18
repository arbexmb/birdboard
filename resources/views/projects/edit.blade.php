@extends ('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white py-8 px-12 mt-2 rounded shadow">
        <h1 class="text-2xl font-normal mb-6 text-center">Edit Your Project</h1>
        <form method="POST" action="{{ $project->path() }}">
            @method('PATCH')
            @include('projects.form', [
                'btnText' => 'Update Project'
            ])
        </form>
    </div>
@endsection