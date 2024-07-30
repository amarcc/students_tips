<div>
    @if($formType === 'create')
        <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $faculty), 'Add Program' => route('faculties.programs.create', $faculty)]"></x-breadcrumbs>
    @else
        <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $faculty), 'Edit Program' => route('faculties.programs.edit', [$faculty, $program])]"></x-breadcrumbs>
    @endif
    <x-card>
        <x-h4-title class="mb-0">{{ $formType === 'create' ? 'Create Program' : 'Edit '}} 

        <a href="{{ route('faculties.programs.index', $faculty) }}" class="text-slate-800 hover:underline hover:text-slate-900">{{ $formType === 'edit' ? $program -> name : ''}} </a>
        </x-h4-title>
        <form action="{{ $formType === 'create' ? route('faculties.programs.store', [$faculty, $program]) : route('faculties.programs.update', [$faculty, $program]) }}" method="POST">
            @csrf
            @if($formType === 'edit')
                @method('PUT')
            @endif
            <div class="mb-4">
                <x-label for="name">Program name</x-label>
                <x-input name="name" :value="$formType === 'create' ? request('name') : $program -> name" placeholder="Enter program name.." :btn="false"></x-input>
            </div>
            <div class="flex gap-2 items-center">
                <x-button type="submit">{{ $formType === 'create' ? 'Add Program' : 'Edit Program'}}</x-button>
                <x-link-button :href="route('faculties.programs.index', $faculty)">Cancel</x-link-button>
            </div>
        </form>
    </x-card>
</div>