<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Hotel') }}
            </h2>
            <a href="{{ route('admin.hotels.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Hotels
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.hotels.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Hotel Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                        </div>

                        <!-- Stars -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ratings</label>
                            <div class="flex flex-row-reverse justify-end space-x-1 space-x-reverse">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="stars" id="star{{ $i }}" value="{{ $i }}" class="hidden" 
                                        {{ old('stars') == $i ? 'checked' : '' }}>

                                    <label for="star{{ $i }}" class="cursor-pointer">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" 
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        
                        <style>
                        /* Fill stars on checked + all previous */
                        input[type="radio"]:checked ~ label svg,
                        input[type="radio"]:checked ~ label ~ label svg {
                            fill: #fbbf24;
                            stroke: #fbbf24;
                        }

                        /* Hover effect */
                        label:hover svg,
                        label:hover ~ label svg {
                            fill: #fbbf24;
                            stroke: #fbbf24;
                        }
                        </style>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label for="price_range" class="block text-sm font-medium text-gray-700">Price Range</label>
                            <input type="text" name="price_range" id="price_range" value="{{ old('price_range') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Contact Info -->
                        <div class="mb-4">
                            <label for="contact_info" class="block text-sm font-medium text-gray-700">Contact Info</label>
                            <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Amenities (comma separated for simplicity) -->
                        <div class="mb-4">
                            <label for="amenities" class="block text-sm font-medium text-gray-700">Amenities (comma separated)</label>
                            <input type="text" name="amenities" id="amenities"
                            value="{{ old('amenities') }}"
                            placeholder="e.g. Free WiFi, Pool, Gym"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="img_url" class="block text-sm font-medium text-gray-700">Hotel Image</label>
                            <input type="file" name="img_url" id="img_url" 
                                class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100">
                        </div>

                        <!-- Featured -->
                        <div class="mb-6">
                            <input type="hidden" name="is_featured" value="0">
                            <label for="is_featured" class="inline-flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Feature this hotel</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md">
                                Create Hotel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
