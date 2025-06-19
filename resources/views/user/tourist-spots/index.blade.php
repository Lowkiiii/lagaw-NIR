<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-8 py-4 space-x-6 w-full">
            <h2 class="font-bold text-3xl text-black leading-tight flex-grow tracking-wide">
                Discover Amazing Tourist Spots
            </h2>
            <!-- Search Bar in the middle -->
            <form method="GET" action="{{ route('user.tourist-spots.index') }}" class="flex-grow max-w-xl">
                <div class="flex items-center gap-4 bg-white border border-gray-300 rounded-full px-4 py-2 shadow-lg focus-within:ring-2 focus-within:ring-blue-500 transition-all ease-in-out hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 011 13.938A5.002 5.002 0 0017 12a5 5 0 00-5-5z" />
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search for tourist spots..."
                        class="flex-grow outline-none bg-transparent text-sm text-gray-700 placeholder-gray-400 focus:ring-0 transition-all ease-in-out hover:scale-105"
                    >
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full text-sm font-semibold shadow-md transform hover:scale-105 transition duration-300">
                        Search
                    </button>
                </div>
            </form>
            <!-- Featured Spots Button -->
            <a href="{{ route('user.tourist-spots.index', ['featured' => true]) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-2 rounded-full text-sm shadow-xl hover:shadow-2xl transition duration-300 transform hover:scale-105">
                Featured Spots
            </a>
        </div>
    </x-slot>

    <div class="py-4 px-4 sm:px-6 lg:px-8">
        <!-- More responsive and tightly packed grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($touristSpots as $spot)
                <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105 relative">
                    @if($spot->img_url)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $spot->img_url) }}"
                                 alt="{{ $spot->name }}"
                                 class="w-full h-48 object-cover rounded-xl shadow">

                            <!-- Itinerary "+" button -->
                            <a href="{{ route('itineraries.create', $spot->id) }}"
                               class="absolute top-2 right-2 bg-blue-600 text-white px-3 py-1.5 rounded-full shadow hover:bg-blue-700 hover:scale-110 transition">
                                <span class="text-xl font-bold">+</span>
                            </a>
                            
                            <!-- Featured badge -->
                            @if($spot->is_featured)
                            <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                ★
                            </div>
                            @endif
                        </div>
                    @endif
                    <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $spot->name }}</h3>
                    <p class="text-sm text-gray-700 mt-1">{{ Str::limit($spot->description, 90) }}</p>
                    <a href="{{ route('user.tourist-spots.show', $spot) }}"
                       class="text-indigo-500 text-sm mt-2 inline-block hover:text-indigo-700">View Details</a>
                    <a href="{{ route('reviews.index', $spot->id) }}"
                       class="text-sm text-green-600 hover:underline mt-1 inline-block">
                        Read Reviews
                    </a>
                </div>
            @empty
                <p class="text-gray-600 text-center col-span-full">No tourist spots found. Maybe try again later!</p>
            @endforelse
        </div>

        <div class="mt-6 text-center">
            {{ $touristSpots->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>