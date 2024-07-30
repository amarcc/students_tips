<x-layout>
    <x-breadcrumbs :form="true" :links="['User' => route('user.show', $user)]"></x-breadcrumbs>
    <x-card>
        <x-h4-title>Account overview</x-h4-title>
        <div class="mb-2 flex flex-col justify-start">
            <x-label class="text-slate-400 ml-1" for="">Name</x-label>
            <x-label  class="ml-1" for="">{{ $user -> name }}</x-label>
        </div>
        <div class="mb-2">
            <x-label class="text-slate-400 ml-1" for="">Email</x-label>
            <x-label  class="ml-1" for="">{{ $user -> email }}</x-label>
        </div>
        <x-link-button :href="url() -> previous()">Go back</x-link-button>
    </x-card>
</x-layout>