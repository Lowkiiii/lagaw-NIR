<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 leading-tight">
                {{ $event->name }}
            </h2>
            <a href="{{ route('user.events.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            @if ($event->img_url)
                <img src="{{ asset('storage/' . $event->img_url) }}" alt="{{ $event->name }}" class="w-full rounded mb-6">
            @else
                <img src="{{ asset('default.jpg') }}" alt="Default Image" class="w-full h-40 object-cover rounded">
            @endif
            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $event->name }}</h3>
                <p class="text-gray-700 mb-6">{{ $event->description }}</p>
                <div class="space-y-3">
                    <p class="text-gray-700"><strong>Location:</strong> {{ $event->location }}</p>
                    <p class="text-gray-700"><strong>Start:</strong> {{ $event->start_date->format('F d, Y') }}</p>
                    <p class="text-gray-700"><strong>End:</strong> {{ $event->end_date->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
