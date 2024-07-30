<div>
    @if($formType === 'create')
        <x-breadcrumbs :links="['Add Faculty' => route('faculties.create')]"></x-breadcrumbs>
    @else
        <x-breadcrumbs :links="['Edit Faculty' => route('faculties.edit', $faculty)]"></x-breadcrumbs>
    @endif
    <x-card>
        <x-h4-title class="mb-0">{{ $formType === 'create' ? 'Create Faculty' : 'Edit '}} 
        @if($formType === 'edit')
            <a href="{{ route('faculties.edit', $faculty) }}" class="text-slate-800 hover:underline hover:text-slate-900">{{ $formType === 'edit' ? $faculty -> name : ''}} </a>
        @endif
        </x-h4-title>
        <form action="{{ $formType === 'create' ? route('faculties.store', $faculty) : route('faculties.update', $faculty) }}" method="POST">
            @csrf
            @if($formType === 'edit')
                @method('PUT')
            @endif
            <div class="mb-4">
                <x-label for="name">Faculty name</x-label>
                <x-input name="name" :value="$formType === 'create' ? request('name') : $faculty -> name" placeholder="Enter faculty name.." :btn="false"></x-input>
            </div>
            <div class="mb-4">
                <x-label for="location">Faculty location</x-label>
                <x-input name="location" :value="$formType === 'create' ? request('name') : $faculty -> location" placeholder="Enter faculty location.." :btn="false"></x-input>
            </div>
            <div class="flex gap-2 items-center">
                <x-button type="submit">{{ $formType === 'create' ? 'Add Faculty' : 'Update faculty'}}</x-button>
                <x-link-button :href="route('faculties.index')">Cancel</x-link-button>
            </div>
        </form>
    </x-card>
</div>