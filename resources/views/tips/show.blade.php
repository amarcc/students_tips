<x-layout>
    <x-breadcrumbs :links="['Programs' => route('faculties.programs.index', $tip -> program -> faculty), 'Tips' => route('programs.tips.index', $tip -> program), 'Replies' => route('programs.tips.show', [$tip -> program, $tip])]"></x-breadcrumbs>
    <x-card>
        <div class="flex items-center gap-2">
            <h3 class="inline mb-2 text-3xl text-slate-700">{{ $tip -> title }}</h3>
            <div class="flex items-center justify-center gap-2 align-middle">
                @php
                    if(Auth::check()){
                        $like = $tip -> likes() -> checkLike(auth() -> user(), $tip);
                    } else {
                        $like = null;
                    }
                @endphp
                @if($like === null)
                    <div class="align-middle text-center flex">
                        <x-like-button name="title" firstColor="black"></x-like-button>
                    </div>
                @elseif(!$like -> count() )
                    <form class="align-middle text-center flex" action="{{route('like.store')}}" method="POST">
                        @csrf
                        <input type="hidden" value="tip" name="type">
                        <input type="hidden" value="{{ $tip -> id }}" name="id">
                        <input type="hidden" value="{{ auth() -> user() -> id . "$$" . $tip -> id }}" name="ind">
                        <x-like-button name="title" firstColor="black"></x-like-button>
                    </form>
                @else
                    <form class="align-middle text-center flex" action="{{route('like.destroy', $like -> id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-like-button name="title" firstColor="green"></x-like-button>
                    </form>
                @endif
                <div class="text-lg align-middle text-center">
                    {{ $tip -> likes_count }}
                </div>
            </div>
        </div>
            <div class="mb-1 ml-1">
            <div>
                <p class="inline text-md text-slate-600">{{ $tip -> desc }}</p>
                @if($tip -> edited)
                    <p class="inline text-sm ml-1 text-slate-400 italic">Edited</p>
                @endif
                <p class="inline align-middle ml-1 text-sm text-slate-400">{{ $tip -> created_at -> diffForHumans() }}</p>
            </div>
            <div class="mb-4">
                @if(Auth::check() && auth() -> user() -> id === $tip -> user -> id)
                    <a href="{{ route('user.edit', $tip -> user) }}" class="text-sm text-slate-500 block-inline hover:underline hover:text-slate-600">By you</a>
                @else
                    <a href="{{ route('user.show', $tip -> user) }}" class="text-sm text-slate-500 block-inline hover:underline hover:text-slate-600">By {{ $tip -> user -> name }}</a>
                @endif
            </div>
            @if(Auth::check())
                <div x-data="">
                    <x-button x-ref="leave-reply" class="mb-4" 
                    @click="
                        $refs['form-desc'].classList = 'display: block';
                        $refs['leave-reply'].classList = 'display: hidden';
                    "
                    >Leave reply</x-button>
                    <form x-ref="form-desc" class='hidden' action="{{ route('tips.reply.store', $tip) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <x-input name="desc" :value="request('desc')" placeholder="Leave reply here..." form="textarea" :btn="false"></x-input>
                        </div>
                        <div class="flex gap-2">
                            <x-button type="submit">Add Reply</x-button>
                            <x-link-button type="btn" 
                            @clicked="
                                $refs['form-desc'].classList = 'hidden';
                                $refs['leave-reply'].classList = 'block';
                            "
                            >Cancel</x-link-button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        @if($replies -> count())
            <div x-data="">
                @foreach ($replies as $index => $reply)
                    <div class="mb-4 ml-2">
                        <div class="mb-1">
                            <div class="mb-1 flex flex-col">
                                <div class="flex gap-1">
                                    <p class="inline-block text-sm text-slate-600">{{ $reply -> desc }}</p>
                                    <div class="flex items-center justify-center gap-2 align-middle">
                                        @php
                                            if(Auth::check()) {
                                                $like = $reply -> likes() -> checkLike(auth() -> user(), $reply);       
                                            } else {
                                                $like = null;
                                            }
                                        @endphp
                                        @if($like === null)
                                            <div class="align-middle text-center flex">
                                                <x-like-button name="title" firstColor="black"></x-like-button>
                                            </div>
                                        @elseif( !$like -> count() )
                                            <form class="align-middle text-center flex" action="{{route('like.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" value="reply" name="type">
                                                <input type="hidden" value="{{ $reply -> id }}" name="id">
                                                <input type="hidden" value="{{ auth() -> user() -> id . "$$" . $reply -> id }}" name="ind">
                                                <x-like-button name="title" firstColor="black"></x-like-button>
                                            </form>
                                        @else
                                            <form class="align-middle text-center flex" action="{{route('like.destroy', $like -> id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <x-like-button name="title" firstColor="green"></x-like-button>
                                            </form>
                                        @endif
                                        <div class="text-xs align-middle text-center">
                                            {{ $reply -> likes_count }}
                                        </div>
                                    </div>
                                </div>
                                @if($reply -> edited)
                                    <p class="inline text-sm text-slate-400 italic">Edited</p>
                                @endif
                                @if(Auth::check() && auth() -> user() -> id === $reply -> user -> id)
                                <a href="{{ route('user.edit', $reply -> user) }}" class="mt-1 text-sm text-slate-400 block-inline hover:underline hover:text-slate-600">By you</a>
                                @else
                                <a href="{{ route('user.show', $reply -> user) }}" class="mt-1 text-sm text-slate-400 block-inline hover:underline hover:text-slate-600">By {{ $reply -> user -> name }}</a>
                                @endif
                            </div>
                                <div class="flex gap-1">
                                <p class="inline text-sm text-slate-400">{{ $reply -> created_at -> diffForHumans() }} 
                            </div>
                        </div>
                        @if(Auth::check() && auth() -> user() -> id === $reply -> user -> id)
                            <div x-ref="edit-{{ $index }}" class="flex gap-1">
                                <x-button class="text-xs" 
                                @click="
                                $refs['form-{{ $index }}'].classList = 'block';
                                $refs['edit-{{ $index }}'].classList = 'display: hidden';
                                "
                                >Edit</x-button>
                                <form action="{{ route('tips.reply.destroy', [$tip, $reply]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" class="text-xs">Delete</x-button>
                                </form>
                            </div>
                            <form x-ref="form-{{ $index }}" class='hidden' action="{{ route('tips.reply.update', [$tip, $reply]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-2">
                                    <x-input name="desc" :value="$reply -> desc" placeholder="Leave reply here..." form="textarea" :btn="false"></x-input>
                                </div>
                                <div class="flex gap-2">
                                    <x-button type="submit">Update Reply</x-button>
                                    <x-link-button type="btn" 
                                    @clicked="
                                        $refs['form-{{ $index }}'].classList = 'display: hidden';
                                        $refs['edit-{{ $index }}'].classList = 'display: block';
                                    "
                                    >Cancel</x-link-button>
                                </div>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <x-h4-message class="mt-2 mb-2">No replies yet</x-h4-message>    
        @endif
    </x-card>
</x-layout>