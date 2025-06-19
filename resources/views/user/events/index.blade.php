<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold text-gray-800">Upcoming Events</h2>
        </div>
    </x-slot>

    <div class="py-4 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($events as $event)
                <div class="bg-white rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105">
                    @if ($event->img_url)
                        <img src="{{ asset('storage/' . $event->img_url) }}" alt="{{ $event->name }}" class="w-full h-40 object-cover rounded-t-xl">
                    @else
                        <img src="{{ asset('default.jpg') }}" alt="Default Image" class="w-full h-40 object-cover rounded-t-xl">
                    @endif
                    
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $event->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($event->description, 100) }}</p>
                        <p class="text-sm text-gray-500 mt-1">📍 {{ $event->location }}</p>
                        <p class="text-sm text-gray-500">📅 {{ $event->start_date->format('M d, Y') }} - {{ $event->end_date->format('M d, Y') }}</p>
                        <div class="mt-2">
                            <a href="{{ route('user.events.show', $event) }}" class="text-blue-500 hover:underline text-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-full">No events found.</p>
            @endforelse
        </div>

        <div class="mt-6 text-center">
            {{ $events->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>
