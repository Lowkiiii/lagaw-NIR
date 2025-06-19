{{-- <x-guest-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Discover the Best Restaurants</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Explore our curated selection of restaurants that offer exceptional dining experiences across various cuisines.</p>
            </div>
        <!-- Featured Restaurants Section -->
        @if(count($featuredRestaurants) > 0)
        <section class="mb-16">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Featured Restaurants</h2>
                <a href="{{ route('user.restaurants.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredRestaurants as $restaurant)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('user.restaurants.show', $restaurant->id) }}">
                        <div class="relative h-52">
                            @if($restaurant->img_url)
                                <img src="{{ $restaurant->img_url }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            @endif
                            
                            <div class="absolute top-2 left-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                ★ Featured
                            </div>
                            
                            @if($restaurant->cuisine_type)
                            <div class="absolute bottom-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ $restaurant->cuisine_type }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg text-blue-700">{{ $restaurant->name }}</h3>
                                @if($restaurant->price_range)
                                    <span class="text-gray-700 font-medium">{{ $restaurant->price_range }}</span>
                                @endif
                            </div>
                            
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $restaurant->description }}</p>
                            
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $restaurant->location }}
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
        @endif
        
        <!-- All Restaurants -->
        <section>
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">All Restaurants</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($restaurants as $restaurant)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ route('user.restaurants.show', $restaurant->id) }}">
                        <div class="relative h-48">
                            @if($restaurant->img_url)
                                <img src="{{ $restaurant->img_url }}" alt="{{ $restaurant->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            @endif
                            
                            @if($restaurant->is_featured)
                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    ★ Featured
                                </div>
                            @endif
                            
                            @if($restaurant->cuisine_type)
                            <div class="absolute bottom-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                {{ $restaurant->cuisine_type }}
                            </div>
                            @endif
                        </div>
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg text-blue-700">{{ $restaurant->name }}</h3>
                                @if($restaurant->price_range)
                                    <span class="text-gray-700 font-medium">{{ $restaurant->price_range }}</span>
                                @endif
                            </div>
                            
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">{{ $restaurant->description }}</p>
                            
                            <div class="mt-3 flex items-center text-xs text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $restaurant->location }}
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500 text-lg">No restaurants found.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $restaurants->links() }}
            </div>
        </section>
    </div>
</div>
</x-guest-layout> --}}