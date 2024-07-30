<x-layout>
    @if($faculties -> count())
        <x-breadcrumbs></x-breadcrumbs>
        <x-h4-title>
            Choose faculty
        </x-h4-title>
        <div x-data="" class="flex gap-2 items-center">
            <form x-ref="form-search" class="flex gap-2" action="{{ route('faculties.index') }}" method="GET">
                <div class="flex gap-2 mb-4 items-center">
                    <div class="grow">
                        <x-input name="search" placeholder="Search faculties..." :value="request('search')"/>
                    </div>
                    <x-button type="submit">Search</x-button>
                    @if(Auth::check() && auth() -> user() -> admin)
                        <x-link-button :href="route('faculties.create')">Add Faculty</x-link-button>
                    @endif        
                </div>
            </form>
        </div>
        @foreach ($faculties as $faculty)
            <x-card>
                <p class="mb-1">{{ $faculty -> name }}</p>
                <p class="mb-1 text-sm text-slate-500">{{ $faculty -> programs_count }} {{ Str::plural('program', $faculty -> programs_count) }}</p>
                <p class="text-sm text-slate-400 mb-2">{{ $faculty -> location }}</p>
                <div class="flex gap-2">
                    <x-link-button :href="route('faculties.programs.index', $faculty)">
                        See programs
                    </x-link-button>
                    @if(Auth::check() && auth() -> user() -> admin)
                        <x-link-button :href="route('faculties.edit', $faculty)">Edit Faculty</x-link-button>
                    @endif 
                </div>
            </x-card>
        @endforeach
        <nav>
            {{ $faculties -> links() }}
        </nav>
    @else
        @if(!request('search'))
            <div class="flex flex-col justify-center items-center gap-8">
                <x-h4-message>No faculty available yet</x-h4-message>
                @if(Auth::check() && auth() -> user() -> admin)
                    <x-link-button class="text-xl font-medium" :href="route('faculties.create')">Add Faculty</x-link-button>
                @endif
            </div>
        @else
            <div class="flex flex-col justify-center items-center gap-2">
                <x-h4-message>We haven't found any faculty. </x-h4-message>
                <x-link-button href="{{route('faculties.index')}}" class="text-indigo-600 block max-w-fit text-xl">Go back</x-link-button> 
            </div>
        @endif
    @endif
</x-layout>