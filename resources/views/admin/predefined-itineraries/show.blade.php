<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Predefined Itinerary Details
            </h2>
            <a href="{{ route('admin.predefined-itineraries.index', $itinerary->tourist_spot_id) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Itineraries
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold text-blue-600 mb-2">{{ $itinerary->title }}</h3>
            <p class="text-gray-700 mb-4">{{ $itinerary->description }}</p>

            <div class="text-sm text-gray-600 mb-4">
               <p class="text-sm text-gray-500"><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($itinerary->visit_date)->toFormattedDateString() }}
                </p>
                <p class="text-sm text-gray-500"><strong>Time:</strong>
                    {{ \Carbon\Carbon::parse($itinerary->visit_time)->format('g:i A') }}
                </p>
                <p><strong>Estimated Budget:</strong> {{ $itinerary->budget_limit ? '₱' . number_format($itinerary->budget_limit, 2) : 'N/A' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
