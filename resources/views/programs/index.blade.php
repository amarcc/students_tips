<x-layout>
    @if($programs -> count())
        <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $faculty)]"></x-breadcrumbs>
        <x-h4-title>
            Choose program
        </x-h4-title>
        <div x-data="" class="flex gap-2 items-center">
            <form x-ref="form-search" class="flex gap-2" action="{{ route('faculties.programs.index', $faculty) }}" method="GET">
                <div class="flex gap-2 mb-4 items-baseline max-w-sm">
                    <div class="grow">
                        <x-input name="search" placeholder="Search faculties..." :value="request('search')"/>
                    </div>
                    <div class="flex items-center gap-2 justify-items-center">
                        <x-button type="submit">Search</x-button>
                        @if(Auth::check() && auth() -> user() -> admin)
                            <x-link-button class="min-w-fit" :href="route('faculties.programs.create', $faculty)">Add Program</x-link-button>
                        @endif        
                    </div>
                </div>
            </form>
        </div>
        @foreach ($programs as $program )
            <x-card>
                <p class="mb-1">{{ $program -> name }}</p>
                <p class="mb-2 text-sm">{{ $program -> tips_count }} {{ Str::plural('tip', $program -> tips_count) }}</p>
                <div class="flex items-center gap-2">
                    <x-link-button :href="route('programs.tips.index', $program)">
                        See tips
                    </x-link-button>
                    @if(Auth::check() && auth() -> user() -> admin)
                        <x-link-button :href="route('faculties.programs.edit', [$program -> faculty, $program])">
                            Edit Program
                        </x-link-button>
                        <form action="{{ route('faculties.programs.destroy', [$program -> faculty, $program]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button>Delete Program</x-button>
                        </form>
                    @endif
                </div>
                
            </x-card>
        @endforeach
    @else
        <div class="flex flex-col justify-center items-center gap-4">
            <x-h4-message>
                @if(!request('search'))
                    This faculty doesn't currently have any available program.
                @else
                    We haven't found any program under this name
                @endif
            </x-h4-message>
                @if(Auth::check() && auth() -> user() -> admin)
                    <x-link-button class="text-xl font-medium" :href="route('faculties.programs.create', $faculty)">Add Program</x-link-button>
                @endif
                <x-link-button class="text-xl font-medium" :href="route('faculties.index')">Go Back</x-link-button>

        </div>
    @endif
</x-layout>