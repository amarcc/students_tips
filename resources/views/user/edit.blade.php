<x-layout>
    <x-breadcrumbs :form="true" :links="['My Account' => route('user.edit', $user)]"></x-breadcrumbs>
    <x-card>
        <div>
            <x-h4-title class="mt-16 mb-16 text-center text-slate-600 text-4xl font-medium">My account</x-h4-title>
            <form action="{{ route('user.update', $user) }}" method="POST" class="mb-2"  x-data="">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <div class="mb-4">
                        <x-label for="name" :required="true">Your name</x-label>
                        <x-input name="name" placeholder="Enter your name..." value="{{ $user -> name }}" :btn="false"></x-input>
                    </div>
                    <div class="mb-4">
                        <x-label for="email" :required="true">Your email</x-label>
                        <x-input name="email" placeholder="Enter your email..." value="{{ $user -> email }}" :btn="false"></x-input>
                    </div>
                    <div class="mb-4">
                        <x-label for="password">Your new password</x-label>
                        <x-input name="password" placeholder="Enter your password..." type="password" :btn="false"></x-input>
                    </div>
                    <x-label for="password">Repeat new password</x-label>
                    <x-input name="rep_password" placeholder="Repeat your password..." type="password" :btn="false"></x-input>
                </div>
                <div class="flex gap-2">
                    <x-button type="submit">
                        Update Account
                    </x-button>
                    <x-link-button href="{{ route('faculties.index') }}">
                        Cancel
                    </x-link-button>
                </div>
            </form>
            <form class="inline" action="{{ route('user.destroy', $user) }}" action="POST">
                @method('DELETE')
                <x-button type="submit">Delete</x-button>
            </form>
        </div>
    </x-card>
</x-layout>