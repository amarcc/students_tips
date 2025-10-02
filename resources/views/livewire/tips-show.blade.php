<x-layout>
    <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $tip -> program -> faculty), 'Tips' => route('programs.tips.index', $tip -> program), 'Replies' => route('programs.tips.show', [$tip -> program, $tip])]"></x-breadcrumbs>
    <x-card>
        <h3 class="mb-2 text-3xl text-slate-700">{{ $tip -> title }}</h3>
        <div class="mb-4 ml-1">
            <div class="mb-2">
                <p class="inline text-md text-slate-600">{{ $tip -> desc }}</p>
                <p class="inline align-middle ml-1 text-sm text-slate-400">{{ $tip -> created_at -> diffForHumans() }}</p>
            </div>
            <div x-data="">
                <x-button x-ref="leave-reply" class="mb-4" 
                @click="
                    $refs['form-desc'].classList = 'display: block'
                    $refs['leave-reply'].classList = 'display: hidden';
                "
                
                >Leave reply</x-button>
                <form x-ref="form-desc" class='hidden' action="{{ route('tips.reply.store', $tip) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <x-input name="desc" :value="request('desc')" placeholder="Leave reply here..." form="textarea" :btn="false"></x-input>
                    </div>
                    <x-button type="submit">Add Reply</x-button>
                </form>
            </div>
        </div>


        @foreach ($tip -> replies() -> oldest() -> get() as $reply)
            <div class="mb-4 ml-2">
                <p class="mb-1 text-sm text-slate-600">{{ $reply -> desc }}</p>
                <p class="text-sm text-slate-400">{{ $reply -> created_at -> diffForHumans() }} 
            </div>
        @endforeach
    </x-card>
</x-layout>