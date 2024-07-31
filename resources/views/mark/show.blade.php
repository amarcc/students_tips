<x-layout :form="true" :mark="true">
    <x-breadcrumbs :links="['Mark' => route('mark.create'), 'Result' => route('mark.show', $num)]"></x-breadcrumbs>
    <x-card>
        <div class="mb-4">
        <x-h4-title class="indent-0">
            Mark Predictor
        </x-h4-title>
            <p class="text-slate-500">Your predicted mark for next exam is <strong class="text-slate-800">{{$num}}</strong></p>
        </div>
        <div class="flex gap-2">
            <x-link-button :href="route('mark.create')">Back</x-link-button>
            <x-link-button :href="route('faculties.index')">Home</x-link-button>
        </div>
    </x-card>
</x-layout>