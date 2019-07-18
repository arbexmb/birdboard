@if(\Request::route()->getName() === 'projects')
<div class="card h-full">
@else
<div class="card">
@endif
    <h3 class="card-title border-blue-300">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>
    <p class="card-description">{{ str_limit($project->description, 255) }}</p>
</div>