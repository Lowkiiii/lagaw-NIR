<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-black-700 leading-tight">
                {{ $touristSpot->name }}
            </h2>
            <a href="{{ route('user.tourist-spots.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left: Tourist Spot Details -->
                <div class="lg:w-2/3 bg-white p-8 shadow-xl rounded-2xl hover:scale-105 hover:shadow-2xl transition-all">
                    @if($touristSpot->img_url)
                        <div class="relative mb-6">
                            <img src="{{ asset('storage/' . $touristSpot->img_url) }}" alt="{{ $touristSpot->name }}"
                                 class="w-full h-auto rounded-2xl border-4 border-white shadow-md">
                            @if($touristSpot->is_featured)
                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md z-10">
                                    ★
                                </div>
                            @endif
                        </div>
                    @endif

                    <h3 class="text-2xl font-bold text-blue-600 mb-4">{{ $touristSpot->name }}</h3>
                    <p class="text-lg text-gray-700 mb-6">{{ $touristSpot->description }}</p>

                    <div class="text-sm text-gray-800 mb-2"><strong class="text-blue-600">Location:</strong> {{ $touristSpot->location }}</div>
                    <div class="text-sm text-gray-800 mb-2"><strong class="text-blue-600">Coordinates:</strong> {{ $touristSpot->latitude }}, {{ $touristSpot->longitude }}</div>
                    <div class="text-sm text-gray-800"><strong class="text-blue-600">Opening Hours:</strong> {{ $touristSpot->openinghours }}</div>
                

                    <!-- Review Button -->
                    <div class="mt-4">
                        <a href="{{ route('reviews.index', $touristSpot->id) }}" 
                        class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-800 py-2 px-4 rounded-lg transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Read & Write Reviews
                        </a>
                    </div>
                </div>

                <!-- Right: Suggested Itineraries -->
                <div class="lg:w-1/3">
                    <h3 class="text-xl font-semibold text-blue-700 mb-4">Suggested Itineraries</h3>

                    @forelse($predefinedItineraries as $itinerary)
                        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                            <h4 class="text-lg font-bold text-blue-600">{{ $itinerary->title }}</h4>
                            <p class="text-gray-700 text-sm mb-2">{{ $itinerary->description }}</p>
                            <div class="text-SM text-gray-500">
                                <p class="text-sm text-gray-500"><strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($itinerary->visit_date)->toFormattedDateString() }}
                                </p>
                                <p class="text-sm text-gray-500"><strong>Time:</strong>
                                    {{ \Carbon\Carbon::parse($itinerary->visit_time)->format('g:i A') }}
                                </p>
                                <strong>Budget:</strong> {{ $itinerary->budget_limit ? '₱' . number_format($itinerary->budget_limit, 2) : 'N/A' }}
                            </div>
                            <form action="{{ route('itineraries.saveFromPredefined', $itinerary->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded shadow mt-3">
                                    Save Itinerary
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="bg-yellow-100 text-yellow-700 p-3 rounded">
                            No suggested itineraries available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
