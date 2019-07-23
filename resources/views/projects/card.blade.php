<div class="card {{ \Request::route()->uri() === 'projects' ? 'h-full' : '' }} relative">
    @if(auth()->user()->is($project->owner))
        <span class="owner-badge">#owner</span>
    @endif
    <h3 class="card-title border-blue-300">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>
    <p class="card-description text-gray-600 font-light px-5">{{ str_limit($project->description, 255) }}</p>
    @can('administer', $project)
        <footer class="text-right mt-3 px-5">
            <form action="{{ $project->path() }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="button text-sm">Delete</button>
            </form>
        </footer>
    @endcan
</div>