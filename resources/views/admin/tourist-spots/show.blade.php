<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tourist Spot Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.tourist-spots.edit', $touristSpot) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('admin.tourist-spots.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-6 relative">
                                @if($touristSpot->img_url)
                                    <img src="{{ asset('storage/' . $touristSpot->img_url) }}" alt="{{ $touristSpot->name }}" class="w-full h-80 object-cover rounded-lg shadow">
                                @else
                                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg shadow">
                                        <span class="text-gray-500">No image available</span>
                                    </div>
                                @endif

                                @if($touristSpot->is_featured)
                                    <div class="absolute top-2 left-2 bg-yellow-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md z-10">
                                        ★ Featured
                                    </div>
                                @endiF
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Basic Information</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">ID</p>
                                            <p class="text-md">{{ $touristSpot->id }}</p>
                                        </div>
                                        {{-- <div>
                                            <p class="text-sm font-medium text-gray-500">Latitude</p>
                                            <p class="text-md">{{ $touristSpot->latitude }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Longitude</p>
                                            <p class="text-md">{{ $touristSpot->longitude }}</p>
                                        </div> --}}
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Opening Hours</p>
                                            <p class="text-md">{{ $touristSpot->openinghours }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Featured</p>
                                            <p class="text-md">
                                                @if($touristSpot->is_featured)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yes</span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">No</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Created At</p>
                                            <p class="text-md">{{ $touristSpot->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Updated At</p>
                                            <p class="text-md">{{ $touristSpot->updated_at->format('M d, Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-6">
                                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $touristSpot->name }}</h1>
                                <div class="flex items-center mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $touristSpot->location }}</span>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                    <p class="text-gray-800 whitespace-pre-line">{{ $touristSpot->description }}</p>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Related Itineraries</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <a href="{{ route('admin.predefined-itineraries.index', $touristSpot->id) }}"
                                       class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                        View Predefined Itineraries
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
