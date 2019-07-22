<div class="card mt-3">
    <h3 class="card-title border-blue-300">
        Invite user to "{{ $project->title }}"
    </h3>
    <footer class="mt-3 px-5">
        <form action="{{ $project->path() . '/invite' }}" method="POST" class="flex mb-1">
            @csrf
            <input 
                type="email"
                name="email" 
                class="border border-grey-500 rounded px-2" 
                style="flex:1;"
                placeholder="Email address" />
            <button type="submit" class="button text-sm ml-2">Invite</button>
        </form>
        @include('errors', ['bag' => 'invitations'])
    </footer>
</div>