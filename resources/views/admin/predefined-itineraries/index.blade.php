<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Predefined Itineraries for {{ $touristSpot->name }}
            </h2>
            <a href="{{ route('admin.tourist-spots.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto">
        @forelse ($predefinedItineraries as $itinerary)
            <div class="bg-white p-6 rounded-lg shadow-md mb-4 relative">
                <h3 class="text-xl font-semibold text-blue-600">{{ $itinerary->title }}</h3>
                <p class="text-gray-700 mb-2">{{ $itinerary->description }}</p>
                <div class="text-sm text-gray-500">
                    <p class="text-sm text-gray-500"><strong>Date:</strong>
                        {{ \Carbon\Carbon::parse($itinerary->visit_date)->toFormattedDateString() }}
                    </p>
                    <p class="text-sm text-gray-500"><strong>Time:</strong>
                        {{ \Carbon\Carbon::parse($itinerary->visit_time)->format('g:i A') }}
                    </p>
                    <strong>Estimated Budget:</strong> {{ $itinerary->budget_limit ? '₱' . number_format($itinerary->budget_limit, 2) : 'N/A' }}
                </div>

                <!-- Action Buttons -->
                <div class="absolute top-4 right-4 flex space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('admin.predefined-itineraries.edit', $itinerary->id) }}" title="Edit"
                       class="text-blue-600 hover:text-blue-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M15.232 5.232l3.536 3.536M9 13l6-6 3.536 3.536L12.536 16.536 9 13z" />
                        </svg>
                    </a>

                     <!-- Show Button -->
                    <a href="{{ route('admin.predefined-itineraries.show', $itinerary->id) }}" title="View"
                       class="text-green-600 hover:text-green-800 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7
                                     c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('admin.predefined-itineraries.destroy', $itinerary->id) }}"
                          onsubmit="return confirm('Are you sure you want to delete this itinerary?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete"
                                class="text-red-600 hover:text-red-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                         M1 7h22M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                No predefined itineraries found for this tourist spot.
            </div>
        @endforelse
    </div>
</x-app-layout>
