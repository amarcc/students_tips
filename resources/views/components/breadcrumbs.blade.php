<div>
    <ul class="flex gap-2 mb-4 text-md text-slate-600 indent-1">
        <li>
            <a href="{{ route('faculties.index') }}">Home</a>
        </li>
        @if(!$form)
            <li>→</li>
            <li>
                <a href="{{ route('faculties.index') }}">Faculties</a>
            </li>
        @endif
        @foreach ($links as $label => $link )
            <li>→</li>
            <li>
                <a href="{{ $link }}"> {{ $label }}
                    
            </a>
            </li>
        @endforeach
    </ul>
</div>