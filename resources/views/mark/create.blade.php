<x-layout :mark="true">
    <x-breadcrumbs :form="true" :links="['Mark' => route('mark.create')]"></x-breadcrumbs>
    <x-card>
        <x-h4-title class="indent-0">
            Mark Predictor
        </x-h4-title>
        <p class="text-lg font-medium mb-4">Enter 5 last marks, time spent learning and ects credit</p>
        <form action="{{ route('mark.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mx-auto max-w-fit">
                <p class="text-lg font-medium">Current:</p>
                <div class="flex gap-4 mx-auto items-start justify-start">
                    <div>
                        <x-label for="currentTimeSpent">Hours Spent Learning</x-label>
                        <x-input name="currentTimeSpent" type="decimal" :value="request('timeSpent{{ $i }}')" :btn="false"></x-input>
                    </div>
                    <div>
                        <x-label for="currentEcts">Ects credits</x-label>
                        <x-input name="currentEcts" type="number" :value="request('ects{{ $i }}')" :btn="false"></x-input>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex flex-col gap-4 mx-auto max-w-fit">
                @for($i = 0; $i < 5; $i++)
                    <div class="flex flex-col mx-auto">
                        <p class="text-lg font-medium">{{ Number::ordinal($i + 1) }}:</p>
                        <div class="flex justify-between gap-4">
                            <div>
                                <x-label for="mark{{$i}}">Mark</x-label>
                                <x-input name="mark{{$i}}" type="number" :value="request('mark{{ $i }}')" :btn="false"></x-input>
                            </div>
                            <div>
                                <x-label for="timeSpent{{$i}}">Hours Spent Learning</x-label>
                                <x-input name="timeSpent{{$i}}" type="decimal" :value="request('timeSpent{{ $i }}')" :btn="false"></x-input>
                            </div>
                            <div>
                                <x-label for="ects{{$i}}">Ects credits</x-label>
                                <x-input name="ects{{$i}}" type="number" :value="request('ects{{ $i }}')" :btn="false"></x-input>
                            </div>
                        </div>
                    </div>
                @endfor
                <x-button type="submit" class="max-w-fit mt-2">Submit</x-button>
            </div>
        </form>
    </x-card>

</x-layout>