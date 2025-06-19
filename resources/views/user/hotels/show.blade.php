<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-black-700 leading-tight">
                {{ $hotel->name }}
            </h2>
            <a href="{{ route('user.hotels.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left: Hotel Image and Main Details -->
            <div class="lg:w-2/3 bg-white p-8 shadow-xl rounded-2xl hover:scale-105 hover:shadow-2xl transition-all">
                @if($hotel->img_url)
                    <div class="relative mb-6">
                        <img src="{{ asset('storage/' . $hotel->img_url) }}" alt="{{ $hotel->name }}"
                             class="w-full h-auto rounded-2xl border-4 border-white shadow-md">
                        @if($hotel->is_featured)
                            <div class="absolute top-2 left-2 bg-yellow-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md z-10">
                                ★
                            </div>
                        @endif
                    </div>
                @endif

                <h3 class="text-2xl font-bold text-blue-600 mb-4">{{ $hotel->name }}</h3>
                
                <!-- Stars Rating -->
                @if($hotel->stars)
                    <div class="flex items-center mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $hotel->stars ? 'text-yellow-500' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm text-gray-600">{{ $hotel->stars }}-Star Hotel</span>
                    </div>
                @endif

                <p class="text-lg text-gray-700 mb-6">{{ $hotel->description }}</p>

                <div class="text-sm text-gray-800 mb-2"><strong class="text-blue-600">Location:</strong> {{ $hotel->location }}</div>
                @if($hotel->price_range)
                    <div class="text-sm text-gray-800 mb-2"><strong class="text-blue-600">Price Range:</strong> {{ $hotel->price_range }}</div>
                @endif
                @if($hotel->contact_info)
                    <div class="text-sm text-gray-800 mb-2"><strong class="text-blue-600">Contact:</strong> {{ $hotel->contact_info }}</div>
                @endif

                <!-- Review Button -->
                <div class="mt-4">
                    <a href="{{ route('hotel.reviews.index', $hotel->id) }}" 
                       class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-800 py-2 px-4 rounded-lg transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Read & Write Reviews
                    </a>
                </div>
            </div>



            <!-- Right: Amenities and Additional Info -->
            <div class="lg:w-1/3">
                <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
                    <h3 class="text-xl font-semibold text-blue-700 mb-4">Amenities</h3>
                    
                    @if(is_array($hotel->amenities) && count($hotel->amenities) > 0)
                        <ul class="space-y-2">
                            @foreach($hotel->amenities as $amenity)
                                <li class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ $amenity }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 italic">No amenities listed for this hotel.</p>
                    @endif
                </div>
                
                <!-- Booking Information Section -->
                <div class="bg-blue-50 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-700 mb-4">Booking Information</h3>
                    <p class="text-gray-700 mb-4">Interested in staying at {{ $hotel->name }}? Contact the hotel directly for reservations and availability.</p>
                    
                    @if($hotel->contact_info)
                        <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
                            <h4 class="font-medium text-blue-600">Contact Details</h4>
                            <p class="text-gray-700">{{ $hotel->contact_info }}</p>
                        </div>
                    @endif
                    
                    <div class="text-sm text-gray-600 mt-4">
                        <p>Please mention that you found this hotel on our platform when making your reservation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>