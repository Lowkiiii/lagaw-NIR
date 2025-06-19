<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Tourist Spot') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.tourist-spots.show', $touristSpot) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('View Details') }}
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
                    <form method="POST" action="{{ route('admin.tourist-spots.update', $touristSpot) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div>
                                <!-- Image Preview -->
                                <div class="mb-6">
                                    @if($touristSpot->img_url)
                                        <img id="image-preview" src="{{ $touristSpot->img_url ? Storage::url($touristSpot->img_url) : '' }}" alt="{{ $touristSpot->name }}" class="w-full h-80 object-cover rounded-lg shadow mb-2">

                                    @else
                                        <div id="image-preview-placeholder" class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg shadow mb-2">
                                            <span class="text-gray-500">No image available</span>
                                        </div>
                                        <img id="image-preview" src="" alt="" class="w-full h-80 object-cover rounded-lg shadow mb-2 hidden">
                                    @endif

                                    <!-- Image Upload -->
                                    <div class="mt-2">
                                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Tourist Spot Image</label>
                                        <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-indigo-50 file:text-indigo-700
                                            hover:file:bg-indigo-100">
                                        @error('image')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Basic Information -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h3>

                                    <!-- Name -->
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $touristSpot->name) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-4">
                                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                        <input type="text" name="location" id="location" value="{{ old('location', $touristSpot->location) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        @error('location')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- <!-- Latitude -->
                                    <div class="mb-4">
                                        <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $touristSpot->latitude) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        @error('latitude')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Longitude -->
                                    <div class="mb-4">
                                        <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $touristSpot->longitude) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        @error('longitude')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div> --}}

                                    <!-- Featured -->
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <input id="is_featured" name="is_featured" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" {{ old('is_featured', $touristSpot->is_featured) ? 'checked' : '' }}>
                                            <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured Tourist Spot</label>
                                        </div>
                                        @error('is_featured')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div>
                                <!-- Description -->
                                <div class="mb-6">
                                    <label for="description" class="block text-lg font-semibold text-gray-700 mb-2">Description</label>
                                    <textarea id="description" name="description" rows="10" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $touristSpot->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Opening Hours -->
                                <div class="mb-6">
                                    <label for="openinghours" class="block text-lg font-semibold text-gray-700 mb-2">Opening Hours</label>
                                    <input type="text" id="openinghours" name="openinghours" value="{{ old('openinghours', $touristSpot->openinghours) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error('openinghours')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="mt-8 border-t border-gray-200 pt-5">
                            <div class="flex justify-end">
                                <button type="button" onclick="window.history.back()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </button>
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update Tourist Spot
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS for image preview -->
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');

                    const placeholder = document.getElementById('image-preview-placeholder');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
