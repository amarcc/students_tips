<x-layout >
    <x-breadcrumbs :form="true" :links="['Signup' => route('user.create')]"></x-breadcrumbs>
    <x-card>
        <x-h4-title class="mt-16 mb-16 text-center text-slate-600 text-4xl font-medium">Sign up for your account</x-h4-title>
        <form action="{{ route('user.store') }}" method="POST"  x-data="">
            @csrf
            <div class="mb-4">
                <div class="mb-4">
                    <x-label for="name" :required="true">Your name</x-label>
                    <x-input name="name" placeholder="Enter your name..." value="{{ request('name') }}" :btn="false"></x-input>
                </div>
                <div class="mb-4">
                    <x-label for="email" :required="true">Your email</x-label>
                    <x-input name="email" placeholder="Enter your email..." value="{{ request('email') }}" :btn="false"></x-input>
                </div>
                <div class="mb-4">
                    <x-label for="password" :required="true">Your password</x-label>
                    <x-input name="password" placeholder="Enter your password..." type="password" :btn="false"></x-input>
                </div>
                <x-label for="password" :required="true">Repeat your password</x-label>
                <x-input name="rep_password" placeholder="Repeat your password..." type="password" :btn="false"></x-input>
            </div>
            <div class="flex flex-col gap-4 justify-between mb-4">
                <div class="flex items-center gap-1">
                    <input type="checkbox" name="remember" @checked(request('remember')) class="rounded-md">
                    <label class="text-sm" for="remember">Remember me</label>
                </div>
                @if(Auth::check() && auth() -> user() -> admin)
                    <div class="flex items-center gap-1">
                        <input type="checkbox" name="admin" @checked(request('remember')) class="rounded-md">
                        <label class="text-sm" for="admin">Admin</label>
                    </div>
                @endif
                <div class="flex flex-col">
                    <a href="{{route('auth.create')}}" class="w-fit text-sm text-indigo-600 font-medium hover:underline">Already have the account?</a>
                </div>
            </div>
                <x-button type="submit">
                    Sign up
                </x-button>
                <x-link-button href="{{ route('faculties.index') }}">
                    Cancel
                </x-link-button>
            </div>
        </form>
    </x-card>
</x-layout>