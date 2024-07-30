<label for="{{ $for }}" 
{{ $attributes -> class(["text-lg mb-1 block"]) }}
>
    {{ $slot }}
    @if($required)
        <span>*</span>
    @endif
</label>