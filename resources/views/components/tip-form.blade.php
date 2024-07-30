<div>
    <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $program -> faculty), $formType === 'create' ? 'Create Tip' : 'Edit Tip'  => $formType === 'create' ? route('programs.tips.create', $program) : route('programs.tips.edit', [$program, $tip])]"></x-breadcrumbs>
    <x-card>
        <x-h4-title class="mb-0">{{ $formType === 'create' ? 'Create' : 'Edit' }} Tip for
            <a href="{{ route('programs.tips.index', $program) }}" class="text-slate-800 hover:underline hover:text-slate-900">{{ $program -> name }}</a> 
        </x-h4-title> 
        <x-h4-title>From<a href="{{ route('faculties.programs.index', $program -> faculty) }}" class="inline-block text-slate-800 hover:underline hover:text-slate-900">{{ $program -> faculty -> name }}</a></x-h4-title>
        <form action="{{ $formType === 'create' ? route('programs.tips.store', $program) : route('programs.tips.update', [$program, $tip]) }}" method="POST">
            @csrf
            @if($formType === 'edit')
                @method('PUT')
            @endif
            <div class="mb-4">
                <x-label for="title">Your title</x-label>
                <x-input name="title" :value="$formType === 'create' ? request('title') : $tip -> title" placeholder="Enter your title.." :btn="false"></x-input>
            </div>
            <div class="mb-4">
                <x-label for="description">Your description</x-label>
                <x-input name="desc" :value="$formType === 'create' ? request('desc') : $tip -> desc" placeholder="Enter your description.." :btn="false" form="textarea">
                </x-input>
            </div>
            <div class="flex gap-2 items-center">
                <x-button type="submit">{{$formType === 'create' ? 'Create Tip' : 'Update Tip'}}</x-button>
                <x-link-button :href="route('programs.tips.index', $program)">Cancel</x-link-button>
            </div>
        </form>
    </x-card>
</div>