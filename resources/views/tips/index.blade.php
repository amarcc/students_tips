<x-layout>
    @if($tips -> count())
        <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $program -> faculty), 'Tips' => route('programs.tips.index', $program)]"></x-breadcrumbs>
        <x-h4-title>Tips</x-h4-title>
        <div x-data="">
            <form x-ref="form-search" action="{{ route('programs.tips.index', $program) }}" method="GET">
                <div class="flex gap-2 mb-4 items-baseline max-w-sm justify-start">
                    <div class="flex flex-col justify-start items-start gap-2">
                        <div class="flex gap-2">
                            <div class="grow">
                                <x-input name="search" placeholder="Search tips..." :value="request('search')"/>
                            </div>
                            <x-button class="min-w-fit" type="submit">Apply filerts</x-button>
                        </div>
                        <div class="flex min-w-fit items-center justify-center gap-2">
                            <input id="mostLikes" type="checkbox" class="rounded block" name="mostLikes" @checked(request('mostLikes'))>
                            <label class="block text-sm text-slate-600 font-medium min-w-fit" for="mostLikes">Sort By Most Likes</label>
                        </div>
                    </div>
                    <x-link-button class="min-w-fit max-h-fit" :href="route('programs.tips.create', $program)">Add Tip</x-link-button>
                </div>        
            </form>
        </div>

        @foreach ($tips as $tip)
            <x-card class="flex flex-col">
                <p class="h-fit text-lg">{{ $tip -> title }}</p>
                
                @if(Auth::check() && auth() -> user() -> id === $tip -> user -> id)
                    <a href="{{ route('user.edit', $tip -> user) }}" class="text-sm text-slate-500 block-inline hover:underline hover:text-slate-600">By you</a>
                @else
                    <a href="{{ route('user.show', $tip -> user) }}" class="text-sm text-slate-500 block-inline hover:underline hover:text-slate-600">By {{ $tip -> user -> name }}</a>
                @endif
                <div class="flex gap-2">
                    <p class="text-sm text-slate-500"> {{ $tip -> likes_count }} {{ Str::plural('like', $tip -> likes_count) }} </p>
                    <p class="text-sm text-slate-500"> {{ $tip -> replies_count }} {{ Str::plural('reply', $tip -> replies_count) }} </p>
                </div>
                <p class="text-sm mb-2 text-slate-400"> {{ $tip -> created_at -> diffForHumans() }} </p>
                <div class="flex gap-2">
                    <x-link-button :href="route('programs.tips.show', [$tip -> program, $tip])">Show</x-link-button>
                    @if(Auth::check() && auth() -> user() -> id === $tip -> user -> id)
                        <div class="flex gap-2">
                            <x-link-button :href="route('programs.tips.edit', [$tip -> program, $tip])">Edit</x-link-button>
                            <form action="{{ route('programs.tips.destroy', [$tip -> program, $tip]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit">Delete</x-button>
                            </form>
                        </div>
                    @endif
                </div>
            </x-card>
        @endforeach
    @else  
        <div class="flex flex-col justify-center items-center gap-4">
            <x-h4-message>No tips yet.</x-h4-message>
            <x-link-button class="text-xl font-medium" :href="route('programs.tips.create', $program)">Add Tip</x-link-button>
            <x-link-button class="text-xl font-medium" :href="route('faculties.programs.index', $program -> faculty)">Go Back</x-link-button>
        </div>
    @endif
</x-layout>