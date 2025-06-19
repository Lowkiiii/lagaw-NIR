<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $cafe->name }}
            </h2>
            <a href="{{ route('user.cafes.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-8 shadow-xl rounded-2xl transform transition-all hover:shadow-2xl relative">
            @if($cafe->img_url)
                <div class="relative mb-6">
                    <img src="{{ $cafe->img_url }}"
                         alt="{{ $cafe->name }}"
                         class="w-full h-auto rounded-2xl border-4 border-white shadow-md">

                    @if($cafe->is_featured)
                        <div class="absolute top-2 left-2 bg-yellow-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md z-10">
                            ★
                        </div>
                    @endif
                    
                    @if($cafe->specialty)
                        <div class="absolute top-2 right-2 bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-full shadow-md">
                            {{ $cafe->specialty }}
                        </div>
                    @endif
                </div>
            @endif

            <h3 class="text-2xl font-bold text-blue-600 mb-4">{{ $cafe->name }}</h3>
            
            <div class="flex items-center mb-4">
                @if($cafe->price_range)
                    <div class="mr-4 px-3 py-1 bg-gray-100 rounded-full text-gray-800 font-medium">
                        {{ $cafe->price_range }}
                    </div>
                @endif
            </div>
            
            <p class="text-lg text-gray-700 mb-6">{{ $cafe->description }}</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h4 class="font-semibold text-blue-600 mb-2">Location</h4>
                    <div class="flex items-center text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $cafe->location }}
                    </div>
                </div>
                
                @if($cafe->contact_info)
                <div>
                    <h4 class="font-semibold text-blue-600 mb-2">Contact</h4>
                    <div class="flex items-center text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ $cafe->contact_info }}
                    </div>
                </div>
                @endif
            </div>
            
            @if($cafe->opening_hours)
                <div class="mb-6">
                    <h4 class="font-semibold text-blue-600 mb-2">Opening Hours</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @php
                            $hours = is_string($cafe->opening_hours) ? json_decode($cafe->opening_hours, true) : $cafe->opening_hours;
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        @endphp

                        @if(is_array($hours))
                            <div class="columns-1 md:columns-2 gap-x-12 space-y-2">
                                @foreach($days as $day)
                                    <div class="break-inside-avoid flex justify-between">
                                        <span class="font-medium">{{ $day }}:</span>
                                        <span>{{ $hours[$day] ?? 'Closed' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>{{ $cafe->opening_hours }}</p>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- Review Button -->
            <div class="mt-4">
                <a href="{{ route('cafe.reviews.index', $cafe->id) }}" 
                class="inline-flex items-center bg-blue-100 hover:bg-blue-200 text-blue-800 py-2 px-4 rounded-lg transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                    Read & Write Reviews
                </a>
            </div>
        </div>
    </div>
</div>
</x-app-layout>