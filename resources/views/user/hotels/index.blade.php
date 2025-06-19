<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-8 py-4 space-x-6 w-full">
            <h2 class="font-bold text-3xl text-black leading-tight flex-grow tracking-wide">
                Discover Amazing Hotels
            </h2>
            <!-- Search Bar in the middle -->
            <form method="GET" action="{{ route('user.hotels.index') }}" class="flex-grow max-w-xl">
                <div class="flex items-center gap-4 bg-white border border-gray-300 rounded-full px-4 py-2 shadow-lg focus-within:ring-2 focus-within:ring-blue-500 transition-all ease-in-out hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search for hotels..."
                        class="flex-grow outline-none bg-transparent text-sm text-gray-700 placeholder-gray-400 focus:ring-0 transition-all ease-in-out hover:scale-105"
                    >
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full text-sm font-semibold shadow-md transform hover:scale-105 transition duration-300">
                        Search
                    </button>
                </div>
            </form>
            <!-- Featured Hotels Button -->
            <a href="{{ route('user.hotels.index', ['featured' => true]) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-2 rounded-full text-sm shadow-xl hover:shadow-2xl transition duration-300 transform hover:scale-105">
                Featured Hotels
            </a>
        </div>
    </x-slot>
<div class="py-4 px-4 sm:px-6 lg:px-8">
    <!-- Grid layout for hotels -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($hotels as $hotel)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105 relative">
                @if($hotel->img_url)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $hotel->img_url) }}"
                             alt="{{ $hotel->name }}"
                             class="w-full h-48 object-cover rounded-xl shadow">
                             
                        @if($hotel->is_featured)
                            <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                ★
                            </div>
                        @endif
                        
                        <!-- Hotel Rating Stars -->
                        @if($hotel->stars)
                            <div class="absolute bottom-2 right-2 bg-white bg-opacity-80 px-2 py-1 rounded-full">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $hotel->stars ? 'text-yellow-500' : 'text-gray-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                
                <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $hotel->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $hotel->location }}</p>
                
                @if($hotel->price_range)
                    <p class="text-sm font-medium text-green-600 mt-1">{{ $hotel->price_range }}</p>
                @endif
                
                <p class="text-sm text-gray-700 mt-1">{{ Str::limit($hotel->description, 90) }}</p>
                
                <a href="{{ route('user.hotels.show', $hotel) }}"
                   class="text-indigo-500 text-sm mt-2 inline-block hover:text-indigo-700">View Details</a>
                   
                <a href="{{ route('hotel.reviews.index', $hotel->id) }}"
                    class="text-sm text-green-600 hover:underline mt-1 inline-block">
                    Read Reviews
                </a>
            </div>
        @empty
            <p class="text-gray-600 text-center col-span-full py-12">No hotels found. Please try again later!</p>
        @endforelse
    </div>

    <div class="mt-6 text-center">
        {{ $hotels->withQueryString()->links() }}
    </div>
</div>
</x-app-layout>