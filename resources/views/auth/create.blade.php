<x-layout :links="false">
    <x-breadcrumbs :form="true" :links="['Login' => route('login')]"></x-breadcrumbs>
    <x-card>
        <x-h4-title class="mt-16 mb-16 text-center text-slate-600 text-4xl font-medium" x-data="">Sign in to your account</x-h4-title>
        <form action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="mb-4" x-data="">
                <div class="mb-4">
                    <x-label for="email" :required="true">Your email</x-label>
                    <x-input name="email" placeholder="Enter your email..." value="{{ request('email') }}" :btn="false"></x-input>
                </div>
                <x-label for="password" :required="true">Your password</x-label>
                <x-input name="password" placeholder="Enter your password..." type="password" :btn="false"></x-input>
            </div>
            <div class="flex flex-col gap-4 justify-between mb-4">
                <div class="flex items-center gap-1">
                    <input id="remember" type="checkbox" name="remember" @checked(request('remember')) class="rounded-md">
                    <label class="text-sm" for="remember">Remember me</label>
                </div>
                <div class="flex flex-col">
                    <a href="#" class="w-fit text-sm text-indigo-600 font-medium hover:underline">Forgot password?</a>
                    <a href="{{route('user.create')}}" class="w-fit text-sm text-indigo-600 font-medium hover:underline">Don't have the account?</a>
                </div>
            </div>
            <div class="flex justify-start gap-2">
                <x-button type="submit">
                    Sign in
                </x-button>
                <x-link-button href="{{ route('faculties.index') }}">
                    Cancel
                </x-link-button>
            </div>
        </form>
    </x-card>
</x-layout>