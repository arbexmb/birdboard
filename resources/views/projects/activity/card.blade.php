<div class="card mt-3 px-5">
    <ul>
        @forelse($project->activity as $activity)
            <li class="card-description {{ $loop->last ? '' : 'mb-1' }}">
                <small>
                    @include("projects.activity.{$activity->description}")
                    <span class="text-gray-500 font-light">{{ $activity->created_at->diffForHumans() }}</span>
                </small>
            </li>
        @empty
            <li class="card-description">Nothing to show yet!</li>
        @endforelse
    </ul>
</div>