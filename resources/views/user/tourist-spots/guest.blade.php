@extends('layouts.public')

@section('content')
<!-- Hero Section with Background Image -->
<div class="relative h-screen">
    <!-- Full-screen background image -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('beachBG.webp') }}');">
        <!-- Overlay to ensure text readability -->
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
        <h1 class="text-6xl md:text-7xl font-bold text-white animate__animated animate__fadeInDown">LAGAW-NIR</h1>
        <p class="text-xl md:text-2xl text-white mt-4 max-w-3xl animate__animated animate__fadeIn">
            Discover the hidden gems of Negros Island Region. Your ultimate travel companion for exploring paradise.
        </p>
        
        <!-- Search Bar -->
        <form action="{{ route('guest.index') }}" method="GET" class="w-full max-w-2xl mt-8 flex items-center animate__animated animate__fadeInUp">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}" class="block w-full pl-10 pr-3 py-3 border border-transparent rounded-l-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-white bg-opacity-90" placeholder="Search destinations, hotels, restaurants...">
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-r-lg transition duration-300">
                Search
            </button>
        </form>

        
        <!-- Search Results Indicator with Jump Links -->
        @if($search)
            <div class="container mx-auto px-4 py-4 mt-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-medium">Search results for: "<span class="font-bold">{{ $search }}</span>"</h3>
                        <a href="{{ route('guest.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Clear search
                        </a>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-2 text-sm">
                        <span class="text-gray-600">Click Here:</span>
                        
                        @if($touristSpots->count() > 0)
                            <a href="#tourist-spots-section" class="bg-green-100 text-green-800 px-3 py-1 rounded-full hover:bg-green-200 transition">
                                Tourist Spots ({{ $touristSpots->total() }})
                            </a>
                        @endif
                        
                        @if($hotels->count() > 0)
                            <a href="#hotels-section" class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full hover:bg-blue-200 transition">
                                Hotels ({{ $hotels->count() }})
                            </a>
                        @endif
                        
                        @if($restaurants->count() > 0)
                            <a href="#restaurants-section" class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full hover:bg-yellow-200 transition">
                                Restaurants ({{ $restaurants->count() }})
                            </a>
                        @endif

                        @if($accommodations->count() > 0)
                            <a href="#accommodations-section" class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full hover:bg-purple-200 transition">
                                Accommodations ({{ $accommodations->count() }})
                            </a>
                        @endif
                        
                        @if($touristSpots->count() == 0 && $hotels->count() == 0 && $restaurants->count() == 0)
                            <span class="text-gray-500">No results found</span>
                        @endif

                        @if($cafes->count() > 0)
                            <a href="#cafes-section" class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full hover:bg-pink-200 transition">
                                Cafes ({{ $cafes->count() }})
                            </a>
                        @endif
                        
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Navigation Menu -->
<div class="bg-white shadow-md py-4 sticky top-0 z-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center mb-4 md:mb-0">
                <span class="text-green-500 mr-2">
                    <img src="/lagaw-icon.png" alt="LAGAW-NIR Logo" class="w-12 h-12 mr-4">
                </span>
                <a href="{{ url()->current() }}">
                    <h2 class="text-2xl font-bold cursor-pointer">LAGAW-NIR</h2>
                </a>
            </div>
            
            <!-- Main Navigation -->
            <div class="flex space-x-6 mb-4 md:mb-0">
                <a href="#tourist-spots-section" class="font-semibold text-gray-700 hover:text-green-500 transition duration-300 scroll-link">Tourist Spots</a>
                <a href="#hotels-section" class="font-semibold text-gray-700 hover:text-green-500 transition duration-300 scroll-link">Hotels</a>
                <a href="#restaurants-section" class="font-semibold text-gray-700 hover:text-green-500 transition duration-300 scroll-link">Restaurants</a>
                <a href="#accommodations-section" class="font-semibold text-gray-700 hover:text-green-500 transition duration-300">Accommodations</a>
                <a href="#cafes-section" class="font-semibold text-gray-700 hover:text-green-500 transition duration-300">Cafes</a>
            </div>
            
            <!-- Auth Buttons -->
            <div class="flex space-x-3">
                <a href="{{ route('login') }}" class="border border-gray-300 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-50 font-semibold transition duration-300">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 font-semibold transition duration-300">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Explore Categories Section -->
<div class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Explore Categories</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
            <div class="bg-white rounded-lg p-6 text-center border hover:shadow-lg transition-all duration-300">
                <div class="text-green-500 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Tourist Spots</h3>
                <p class="text-gray-500 mt-2 mb-4">Discover breathtaking natural wonders and attractions</p>
                <a href="#tourist-spots-section" class="text-green-500 font-medium hover:text-green-600 transition duration-300 scroll-link">Explore</a>
            </div>
            
            <div class="bg-white rounded-lg p-6 text-center border hover:shadow-lg transition-all duration-300">
                <div class="text-green-500 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Hotels</h3>
                <p class="text-gray-500 mt-2 mb-4">Find luxurious and comfortable places to stay</p>
                <a href="#hotels-section" class="text-green-500 font-medium hover:text-green-600 transition duration-300 scroll-link">Explore</a>
            </div>
            
            <div class="bg-white rounded-lg p-6 text-center border hover:shadow-lg transition-all duration-300">
                <div class="text-green-500 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Restaurants</h3>
                <p class="text-gray-500 mt-2 mb-4">Taste the local cuisine and international dishes</p><br>
                <a href="#restaurants-section" class="text-green-500 font-medium hover:text-green-600 transition duration-300 scroll-link">Explore</a>
            </div>
            
            <div class="bg-white rounded-lg p-6 text-center border hover:shadow-lg transition-all duration-300">
                <div class="text-green-500 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Accommodations</h3>
                <p class="text-gray-500 mt-2 mb-4">Explore various lodging options for every budget</p><br>
                <a href="#accommodations-section" class="text-green-500 font-medium hover:text-green-600 transition duration-300">Explore</a>
            </div>
            
            <div class="bg-white rounded-lg p-6 text-center border hover:shadow-lg transition-all duration-300">
                <div class="text-green-500 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold">Cafes</h3>
                <p class="text-gray-500 mt-2 mb-4">Relax in cozy cafes with delicious beverages</p><br>
                <a href="#cafes-section" class="text-green-500 font-medium hover:text-green-600 transition duration-300">Explore</a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Destinations Section -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Explore Destinations</h2>
    </div>
</div>

<!-- Tourist Spots Section (dynamic content based on your database) -->
<div class="bg-white py-16" id="tourist-spots-section">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Tourist Spots</h2>
        
        @if(count($touristSpots) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($touristSpots as $spot)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2">
                        <div class="relative h-60">
                            @if ($spot->img_url)
                                <img src="{{ asset('storage/' . $spot->img_url) }}" alt="{{ $spot->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            @if($spot->is_featured)
                                <span class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">Featured</span>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $spot->name }}</h3>
                            
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $spot->location }}</span>
                            </div>
                            
                            <p class="text-gray-600 mb-4">{{ Str::limit($spot->description, 100) }}</p>
                            
                            <div class="flex justify-center">
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Login for more details</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No tourist spots found</h3>
                <p class="mt-1 text-gray-500">Try again later or check out our other categories.</p>
            </div>
        @endif
    </div>
</div>

<!-- Hotels Section (new section) -->
<div class="bg-gray-50 py-16" id="hotels-section">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Hotels</h2>
        
        @if(isset($hotels) && count($hotels) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($hotels as $hotel)
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
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-xl flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $hotel->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $hotel->location }}</p>
                        
                        @if($hotel->price_range)
                            <p class="text-sm font-medium text-green-600 mt-1">{{ $hotel->price_range }}</p>
                        @endif
                        
                        <p class="text-sm text-gray-700 mt-1">{{ Str::limit($hotel->description, 90) }}</p>
                        
                        <div class="flex justify-center mt-4">
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Login for more details</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No hotels found</h3>
                <p class="mt-1 text-gray-500">Try again later or check out other categories.</p>
            </div>
        @endif
    </div>
</div>

<!-- Restaurants Section -->
<div class="bg-white py-16" id="restaurants-section">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Restaurants</h2>
        
        @if(isset($restaurants) && count($restaurants) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($restaurants as $restaurant)
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105 relative">
                        <div class="relative">
                            @if($restaurant->img_url)
                                <img src="{{ $restaurant->img_url }}" 
                                     alt="{{ $restaurant->name }}" 
                                     class="w-full h-48 object-cover rounded-xl shadow">
                            @else
                                <div class="flex items-center justify-center h-48 bg-gray-200 rounded-xl">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            @endif
                            
                            @if($restaurant->is_featured)
                                <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    ★
                                </div>
                            @endif
                            
                            @if($restaurant->cuisine_type)
                                <div class="absolute bottom-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $restaurant->cuisine_type }}
                                </div>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $restaurant->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $restaurant->location }}</p>
                        
                        @if($restaurant->price_range)
                            <p class="text-sm font-medium text-green-600 mt-1">{{ $restaurant->price_range }}</p>
                        @endif
                        
                        <p class="text-sm text-gray-700 mt-1">{{ Str::limit($restaurant->description, 90) }}</p>
                        
                        <div class="flex justify-center mt-4">
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Login for more details</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No restaurants found</h3>
                <p class="mt-1 text-gray-500">Try again later or check out other categories.</p>
            </div>
        @endif
    </div>
</div>

<!-- Add this section after the Restaurants Section -->
<div class="bg-gray-50 py-16" id="accommodations-section">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Accommodations</h2>
        
        @if(isset($accommodations) && count($accommodations) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($accommodations as $accommodation)
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105 relative">
                        <div class="relative">
                            @if($accommodation->img_url)
                                <img src="{{ $accommodation->img_url }}" 
                                     alt="{{ $accommodation->name }}" 
                                     class="w-full h-48 object-cover rounded-xl shadow">
                            @else
                                <div class="flex items-center justify-center h-48 bg-gray-200 rounded-xl">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            @endif
                            
                            @if($accommodation->is_featured)
                                <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                    ★
                                </div>
                            @endif
                            
                            @if($accommodation->accommodation_type)
                                <div class="absolute bottom-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $accommodation->accommodation_type }}
                                </div>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $accommodation->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $accommodation->location }}</p>
                        
                        @if($accommodation->price_range)
                            <p class="text-sm font-medium text-green-600 mt-1">{{ $accommodation->price_range }}</p>
                        @endif
                        
                        <p class="text-sm text-gray-700 mt-1">{{ Str::limit($accommodation->description, 90) }}</p>
                        
                        <div class="flex justify-center mt-4">
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Login for more details</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No accommodations found</h3>
                <p class="mt-1 text-gray-500">Try again later or check out other categories.</p>
            </div>
        @endif
    </div>
</div>

<!-- Cafes Section -->
<div class="bg-gray-50 py-16" id="cafes-section">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-10">Cafes</h2>
        
        @if(isset($cafes) && count($cafes) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($cafes as $cafe)
                    <div class="bg-white p-4 rounded-xl shadow hover:shadow-xl transition-transform transform hover:scale-105 relative">
                        <div class="relative">
                            @if($cafe->img_url)
                                <img src="{{ $cafe->img_url }}" 
                                     alt="{{ $cafe->name }}" 
                                     class="w-full h-48 object-cover rounded-xl shadow">
                                     
                                @if($cafe->is_featured)
                                    <div class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                                        ★
                                    </div>
                                @endif
                                
                                @if($cafe->specialty)
                                    <div class="absolute bottom-2 right-2 bg-purple-600 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $cafe->specialty }}
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-xl flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <h3 class="text-lg font-semibold mt-3 text-blue-600">{{ $cafe->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $cafe->location }}</p>
                        
                        @if($cafe->price_range)
                            <p class="text-sm font-medium text-green-600 mt-1">{{ $cafe->price_range }}</p>
                        @endif
                        
                        <p class="text-sm text-gray-700 mt-1">{{ Str::limit($cafe->description, 90) }}</p>
                        
                        <div class="flex justify-center mt-4">
                            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">Login for more details</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No cafes found</h3>
                <p class="mt-1 text-gray-500">Try again later or check out other categories.</p>
            </div>
        @endif
    </div>
</div>

<!-- Footer -->
<footer class="bg-white border-t">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and Tagline -->
            <div>
                <div class="flex items-center mb-4">
                    <span class="text-green-500 mr-2">
                        <img src="/lagaw-icon.png" alt="LAGAW-NIR Logo" class="w-12 h-12 mr-4">
                    </span>
                    <h2 class="text-2xl font-bold">LAGAW-NIR</h2>
                </div>
                <p class="text-gray-500">Your ultimate travel companion for exploring the Negros Island Region.</p>
            </div>
            
            <!-- Explore Links -->
            <div>
                <h3 class="text-lg font-semibold uppercase mb-4">Explore</h3>
                <ul class="space-y-2">
                    <li><a href="#tourist-spots-section" class="text-gray-500 hover:text-green-500 transition duration-300 scroll-link">Tourist Spots</a></li>
                    <li><a href="#hotels-section" class="text-gray-500 hover:text-green-500 transition duration-300 scroll-link">Hotels</a></li>
                    <li><a href="#restaurants-section" class="text-gray-500 hover:text-green-500 transition duration-300 scroll-link">Restaurants</a></li>
                    <li><a href="#accommodations-section" class="text-gray-500 hover:text-green-500 transition duration-300">Accommodations</a></li>
                    <li><a href="#cafes-section" class="text-gray-500 hover:text-green-500 transition duration-300">Cafes</a></li>
                </ul>
            </div>
            <!-- About -->
            <div>
                <h3 class="text-lg font-semibold uppercase mb-4">About</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-500 hover:text-green-500 transition duration-300">About Us</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-green-500 transition duration-300">Contact</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-green-500 transition duration-300">Careers</a></li>
                    <li><a href="#" class="text-gray-500 hover:text-green-500 transition duration-300">Blog</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-lg font-semibold uppercase mb-4">Legal</h3>
                <ul class="space-y-2 text-gray-500">
                    <li>Terms of Service</li>
                    <li>Privacy Policy</li>
                    <li>Cookie Policy</li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center text-sm text-gray-400 mt-10">
            &copy; 2025 LAGAW-NIR. All rights reserved.
        </div>
    </div>
</footer>

<!-- JavaScript for smooth scrolling -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scrolling for elements with class 'scroll-link'
        const scrollLinks = document.querySelectorAll('.scroll-link');
        
        scrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80, // Offset for the sticky header
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('border-green-500');
                    btn.classList.add('border-transparent');
                    btn.classList.remove('text-gray');
                btn.classList.add('text-gray-500');
            });
            
            // Add active class to clicked button
            this.classList.remove('border-transparent');
            this.classList.add('border-green-500');
            this.classList.remove('text-gray-500');
            this.classList.add('text-gray-900');
            
            // Get target section ID
            const targetId = this.getAttribute('data-target');
            
            // Smooth scroll to target section
            const targetSection = document.getElementById(targetId);
            if (targetSection) {
                window.scrollTo({
                    top: targetSection.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Add animation classes on scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate__animated');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                const animationClass = element.dataset.animation || 'animate__fadeIn';
                element.classList.add(animationClass);
            }
        });
    };
    
    // Run animation check on load and scroll
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run once on page load
});

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the search value from URL
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get('search');
    
    // If there's a search term and a first result type, scroll to that section
    if (searchQuery && '{{ $firstResultType ?? "" }}') {
        const targetSection = document.getElementById('{{ $firstResultType ?? "" }}');
        if (targetSection) {
            // Scroll to the section after a short delay to ensure page is loaded
            setTimeout(() => {
                window.scrollTo({
                    top: targetSection.offsetTop - 80, // Account for sticky header
                    behavior: 'smooth'
                });
                
                // Add a highlight animation class to the section
                targetSection.classList.add('search-highlight');
                setTimeout(() => {
                    targetSection.classList.remove('search-highlight');
                }, 2000);
            }, 300);
        }
        
        // Highlight the actual matching items
        if (searchQuery.length > 2) { // Only highlight for meaningful search terms
            highlightSearchResults(searchQuery);
        }
    }
    
    // Search input functionality
    const searchInput = document.querySelector('input[name="search"]');
    
    if (searchInput) {
        // If there's a search value in URL, set it in the input
        if (searchQuery) {
            searchInput.value = searchQuery;
        }
        
        // Focus the search input when pressing '/' key
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
                e.preventDefault();
                searchInput.focus();
            }
        });

        // Clear search button functionality
        const clearSearchButtons = document.querySelectorAll('a[href="{{ route('guest.index') }}"]');
        clearSearchButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (searchInput.value || window.location.search) {
                    searchInput.value = '';
                    e.preventDefault();
                    window.location.href = "{{ route('guest.index') }}";
                }
            });
        });
    }
    
    // Function to highlight search results in the page
    function highlightSearchResults(query) {
        const searchSections = [
            document.getElementById('tourist-spots-section'),
            document.getElementById('hotels-section'),
            document.getElementById('restaurants-section')
        ];
        
        searchSections.forEach(section => {
            if (!section) return;
            
            // Get all text elements within cards/items
            const titleElements = section.querySelectorAll('h3');
            const descElements = section.querySelectorAll('p');
            const locationElements = section.querySelectorAll('.text-gray-600 span'); // Location spans
            
            // Highlight function for elements
            const highlightElement = (element) => {
                if (!element || !element.textContent) return;
                
                const content = element.textContent;
                const lowerCaseContent = content.toLowerCase();
                const lowerCaseQuery = query.toLowerCase();
                
                if (lowerCaseContent.includes(lowerCaseQuery)) {
                    // Only highlight if not already highlighted
                    if (!element.classList.contains('search-text-highlight')) {
                        element.classList.add('search-text-highlight');
                        
                        // Optional: Scroll card into view if it contains the search term
                        const card = element.closest('.bg-white.rounded-xl');
                        if (card) {
                            card.classList.add('search-card-highlight');
                            setTimeout(() => {
                                card.classList.remove('search-card-highlight');
                            }, 3000);
                        }
                    }
                }
            };
            
            // Apply highlighting to all relevant elements
            titleElements.forEach(highlightElement);
            descElements.forEach(highlightElement);
            locationElements.forEach(highlightElement);
        });
    }
});
</script>

<!-- Add these styles to your head section or in a separate CSS file -->
<style>
/* Search highlight animations */
.search-highlight {
    animation: pulse-highlight 2s ease-in-out;
}

.search-text-highlight {
    background-color: rgba(255, 255, 0, 0.3);
    padding: 0 2px;
    border-radius: 2px;
}

.search-card-highlight {
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.5);
    transform: translateY(-4px);
    transition: all 0.5s ease;
}

@keyframes pulse-highlight {
    0% { background-color: transparent; }
    30% { background-color: rgba(16, 185, 129, 0.1); }
    100% { background-color: transparent; }
}
</style>