<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center px-8 py-4 space-x-6 w-full">
            <h2 class="font-bold text-3xl text-black leading-tight flex-grow tracking-wide">
                Discover Amazing Accommodations
            </h2>
            <!-- Search Bar in the middle -->
            <form method="GET" action="{{ route('user.accommodations.index') }}" class="flex-grow max-w-xl">
                <div class="flex items-center gap-4 bg-white border border-gray-300 rounded-full px-4 py-2 shadow-lg focus-within:ring-2 focus-within:ring-blue-500 transition-all ease-in-out hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search for accommodations..."
                        class="flex-grow outline-none bg-transparent text-sm text-gray-700 placeholder-gray-400 focus:ring-0 transition-all ease-in-out hover:scale-105"
                    >
                    <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-full text-sm font-semibold shadow-md transform hover:scale-105 transition duration-300">
                        Search
                    </button>
                </div>
            </form>
            <!-- Featured Accommodations Button -->
            <a href="{{ route('user.accommodations.index', ['featured' => true]) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-2 rounded-full text-sm shadow-xl hover:shadow-2xl transition duration-300 transform hover:scale-105">
                Featured Accommodations
            </a>
        </div>
    </x-slot>
<div class="py-4 px-4 sm:px-6 lg:px-8">
    <!-- Grid layout for accommodations -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($accommodations as $accommodation)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105 relative">
                @if($accommodation->img_url)
                    <div class="relative">
                        <img src="{{ $accommodation->img_url }}"
                             alt="{{ $accommodation->name }}"
                             class="w-full h-48 object-cover rounded-xl shadow">
                             
                        @if($accommodation->is_featured)
                            <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                ★ Featured
                            </div>
                        @endif
                    </div>
                @else
                    <div class="w-full h-48 bg-gray-200 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                @endif
                
                <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $accommodation->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $accommodation->location }}</p>
                
                <div class="flex items-center mt-1">
                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $accommodation->type }}</span>
                </div>
                
                @if($accommodation->price_range)
                    <p class="text-sm font-medium text-green-600 mt-2">{{ $accommodation->price_range }}</p>
                @endif
                
                <p class="text-sm text-gray-700 mt-2">{{ Str::limit($accommodation->description, 90) }}</p>
                
                <a href="{{ route('user.accommodations.show', $accommodation) }}"
                    class="text-indigo-500 text-sm hover:text-indigo-700">View Details</a>
                
                <a href="{{ route('accommodation.reviews.index', $accommodation->id) }}"
                    class="text-sm text-green-600 hover:underline mt-1 inline-block">
                    Read Reviews
                </a>
        
            </div>
        @empty
            <p class="text-gray-600 text-center col-span-full py-12">No accommodations found. Please try again later!</p>
        @endforelse
    </div>

    <div class="mt-6 text-center">
        {{ $accommodations->withQueryString()->links() }}
    </div>
</div>
</x-app-layout>