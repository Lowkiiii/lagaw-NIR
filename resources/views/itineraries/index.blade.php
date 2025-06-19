<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-black-700 leading-tight">My Itineraries</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse ($itineraries as $itinerary)
                <div class="bg-white shadow-lg rounded-2xl p-6 transform transition-all hover:scale-105 hover:shadow-2xl">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-semibold text-blue-600 mb-2">{{ $itinerary->title }}</h3>
                            <p class="text-sm text-gray-700">
                                📅 {{ \Carbon\Carbon::parse($itinerary->visit_date)->toFormattedDateString() }} 
                                | ⏰ {{ \Carbon\Carbon::parse($itinerary->visit_time)->format('g:i A') }}
                            </p>
                            @if($itinerary->budget_limit)
                                <p class="text-sm text-gray-700">💸 Budget: ₱{{ number_format($itinerary->budget_limit, 2) }}</p>
                            @endif
                            <p class="text-sm text-gray-600 mt-2">{{ $itinerary->notes }}</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4 items-center">
                            <a href="{{ route('itineraries.show', $itinerary->id) }}" title="View" class="text-blue-500 hover:text-blue-700 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                            <a href="{{ route('itineraries.edit', $itinerary->id) }}" title="Edit" class="text-yellow-500 hover:text-yellow-600 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6L3 21l2.828-7.828L9 11z" />
                                </svg>
                            </a>
                            <form action="{{ route('itineraries.destroy', $itinerary->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this itinerary?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" class="text-red-500 hover:text-red-700 transition duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H4m16 0H4" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center text-lg">You have no itineraries yet. Start planning your next adventure!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
