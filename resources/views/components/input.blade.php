<div class="relative" x-data="">
    @if(!$form)
        @if($btn)
            <button type="button" class="absolute top-0 right-0 flex h-full items-center pr-2" 
            @click="$refs['input-{{ $name }}'].value='';
            $refs['form-{{ $name }}'].submit()"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-slate-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
        @if($type === 'password')
            <button type="button" class="absolute top-0 right-0 flex h-full items-center pr-2"
            x-data="{showClose{{ $name }}: true, showOpen{{ $name }}: false}" 
            @click="
                showClose{{ $name }} = !showClose{{ $name }};
                showOpen{{ $name }} = !showOpen{{ $name }};

                if($refs['input-{{ $name }}'].type === 'password'){
                    $refs['input-{{ $name }}'].type='text';
                } else {
                    $refs['input-{{ $name }}'].type='password';
                }
            "> 
            <svg x-show="showClose{{ $name }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            <svg x-show="showOpen{{ $name }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>

            </button>

        @endif
        <input x-ref="input-{{ $name }}" placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ old($name, $value) }}" type="{{ $type }}"
        @class([
            "pr-7 w-full block px-2.5 py-1.5 rounded-sm border border-slate-300 text-sm ring-1",
            'ring-slate-300' => !$errors -> has($name),
            'ring-red-300' => $errors -> has($name)
        ])
        >
    @else
        <textarea x-ref="input-{{ $name }}" placeholder="{{ $placeholder }}" name="{{ $name }}" type="{{ $type }}" rows="{{ $rows }}"
        @class([
            "w-full block px-2.5 py-1.5 rounded-sm border border-slate-300 text-sm ring-1",
            'ring-slate-300' => !$errors -> has($name),
            'ring-red-300' => $errors -> has($name)
        ])
        >{{ old($name, $value) }}</textarea>
    @endif
    @error($name)
        <div class="mt-1 text-sm text-red-600">
            {{ $message }}
        </div>
    @enderror
</div>
