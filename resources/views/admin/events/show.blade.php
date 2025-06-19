<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $event->name }}
            </h2>
            <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($event->img_url)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $event->img_url) }}" alt="{{ $event->name }}" class="w-full h-auto rounded">
                    </div>
                @endif

                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Description:</h3>
                    <p>{{ $event->description ?? 'N/A' }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Location:</h3>
                    <p>{{ $event->location }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Start Date:</h3>
                    <p>{{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-lg font-semibold">End Date:</h3>
                    <p>{{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}</p>
                </div>
{{-- 
                <div>
                    <h3 class="text-lg font-semibold">Coordinates:</h3>
                    <p>Latitude: {{ $event->latitude ?? 'N/A' }}, Longitude: {{ $event->longitude ?? 'N/A' }}</p>
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
