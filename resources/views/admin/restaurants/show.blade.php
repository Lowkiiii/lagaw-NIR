<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Restaurant Details') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('admin.restaurants.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                            <div class="mb-6">
                                @if($restaurant->img_url)
                                    <img src="{{ $restaurant->img_url }}" alt="{{ $restaurant->name }}" class="w-full h-80 object-cover rounded-lg shadow">
                                @else
                                    <div class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg shadow">
                                        <span class="text-gray-500">No image available</span>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Basic Information</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">ID</p>
                                            <p class="text-md">{{ $restaurant->id }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Location</p>
                                            <p class="text-md">{{ $restaurant->location }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Created At</p>
                                            <p class="text-md">{{ $restaurant->created_at->format('M d, Y H:i') }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Updated At</p>
                                            <p class="text-md">{{ $restaurant->updated_at->format('M d, Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="mb-6">
                                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $restaurant->name }}</h1>
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                                    <p class="text-gray-800 whitespace-pre-line">{{ $restaurant->description }}</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Opening Hours</h3>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    @if(!empty($restaurant->opening_hours_display))
                                        <div class="grid grid-cols-1 gap-2">
                                            @foreach($restaurant->opening_hours_display as $day => $hours)
                                                <div class="flex justify-between">
                                                    <span class="font-medium">{{ $day }}</span>
                                                    <span>{{ $hours }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-500">No opening hours available</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
