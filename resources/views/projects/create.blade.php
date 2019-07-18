@extends ('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white py-8 px-12 mt-2 rounded shadow">
        <h1 class="text-2xl font-normal mb-8 text-center">Let's start something new</h1>
        <form method="POST" action="/projects">
            @include('projects.form', [
                'project' => new App\Project,
                'btnText' => 'Create Project'
            ])
        </form>
    </div>
@endsection