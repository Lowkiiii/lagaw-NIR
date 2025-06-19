<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Accommodation') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('admin.accommodations.show', $accommodation) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('View Details') }}
                </a>
                <a href="{{ route('admin.accommodations.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Back to List') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.accommodations.update', $accommodation) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div>
                                <!-- Image Preview -->
                                <div class="mb-6">
                                    @if($accommodation->img_url)
                                        <img id="image-preview" src="{{ $accommodation->img_url }}" alt="{{ $accommodation->name }}" class="w-full h-80 object-cover rounded-lg shadow mb-2">
                                    @else
                                        <div id="image-preview-placeholder" class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg shadow mb-2">
                                            <span class="text-gray-500">No image available</span>
                                        </div>
                                        <img id="image-preview" src="" alt="" class="w-full h-80 object-cover rounded-lg shadow mb-2 hidden">
                                    @endif

                                    <!-- Image Upload -->
                                    <div class="mt-2">
                                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Accommodation Image</label>
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

                                <!-- Basic Information Section -->
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h3>
                                    
                                    <!-- Name -->
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name', $accommodation->name) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        @error('name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-4">
                                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                        <input type="text" name="location" id="location" value="{{ old('location', $accommodation->location) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        @error('location')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Type -->
                                    <div class="mb-4">
                                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                        <select id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="Hotel" {{ old('type', $accommodation->type) == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                            <option value="Resort" {{ old('type', $accommodation->type) == 'Resort' ? 'selected' : '' }}>Resort</option>
                                            <option value="Apartment" {{ old('type', $accommodation->type) == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                            <option value="Villa" {{ old('type', $accommodation->type) == 'Villa' ? 'selected' : '' }}>Villa</option>
                                            <option value="Hostel" {{ old('type', $accommodation->type) == 'Hostel' ? 'selected' : '' }}>Hostel</option>
                                            <option value="Homestay" {{ old('type', $accommodation->type) == 'Homestay' ? 'selected' : '' }}>Homestay</option>
                                        </select>
                                        @error('type')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price Range -->
                                    <div class="mb-4">
                                        <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                                        <input type="text" name="price_range" id="price_range" value="{{ old('price_range', $accommodation->price_range) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g. $50-$100">
                                        @error('price_range')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Featured -->
                                    <div class="mb-4 flex items-center space-x-2">
                                        <input type="hidden" name="is_featured" value="0">
                                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $accommodation->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <label for="is_featured" class="block text-sm font-medium text-gray-700">Featured?</label>
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
                                    <textarea id="description" name="description" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $accommodation->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Contact Information -->
                                <div class="mb-6">
                                    <label for="contact_info" class="block text-lg font-semibold text-gray-700 mb-2">Contact Information</label>
                                    <textarea id="contact_info" name="contact_info" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('contact_info', $accommodation->contact_info) }}</textarea>
                                    @error('contact_info')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Amenities -->
                                <div>
                                    <label class="block text-lg font-semibold text-gray-700 mb-2">Amenities</label>
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="grid grid-cols-2 gap-2">
                                            @php
                                                $commonAmenities = [
                                                    'Free WiFi', 'Swimming Pool', 'Air Conditioning', 'Free Parking',
                                                    'Restaurant', 'Room Service', 'Fitness Center', 'Spa',
                                                    'Bar/Lounge', 'Breakfast Included', 'Pet Friendly', 'Laundry Service',
                                                    'Business Center', 'Airport Shuttle', 'Family Rooms', 'Smoking Rooms'
                                                ];
                                                
                                                $accommodationAmenities = is_array($accommodation->amenities) ? $accommodation->amenities : [];
                                            @endphp

                                            @foreach($commonAmenities as $amenity)
                                                <div class="flex items-center">
                                                    <input id="amenity-{{ Str::slug($amenity) }}" name="amenities[]" value="{{ $amenity }}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                                        {{ in_array($amenity, old('amenities', $accommodationAmenities)) ? 'checked' : '' }}>
                                                    <label for="amenity-{{ Str::slug($amenity) }}" class="ml-2 block text-sm text-gray-700">{{ $amenity }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <!-- Custom Amenity -->
                                        <div class="mt-4">
                                            <label for="custom_amenity" class="block text-sm font-medium text-gray-700 mb-1">Add Custom Amenity</label>
                                            <div class="flex">
                                                <input type="text" id="custom_amenity" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md rounded-r-none" placeholder="e.g. Beach Access">
                                                <button type="button" id="add_amenity" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Custom Amenities List -->
                                        <div id="custom_amenities_list" class="mt-2 grid grid-cols-2 gap-2">
                                            @php
                                                $customAmenities = array_diff($accommodationAmenities, $commonAmenities);
                                            @endphp
                                            
                                            @foreach($customAmenities as $customAmenity)
                                                <div class="flex items-center custom-amenity">
                                                    <input name="amenities[]" value="{{ $customAmenity }}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                                                    <label class="ml-2 block text-sm text-gray-700">{{ $customAmenity }}</label>
                                                    <button type="button" class="ml-2 remove-amenity text-red-500 hover:text-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('amenities')
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
                                    Update Accommodation
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for image preview and custom amenities -->
    <script>
        // Image preview
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

        // Add custom amenity
        document.getElementById('add_amenity').addEventListener('click', function() {
            const customAmenityInput = document.getElementById('custom_amenity');
            const amenityValue = customAmenityInput.value.trim();
            
            if (amenityValue !== '') {
                const customAmenitiesList = document.getElementById('custom_amenities_list');
                
                // Create new amenity element
                const amenityDiv = document.createElement('div');
                amenityDiv.className = 'flex items-center custom-amenity';
                
                // Create checkbox
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'amenities[]';
                checkbox.value = amenityValue;
                checkbox.className = 'h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded';
                checkbox.checked = true;
                
                // Create label
                const label = document.createElement('label');
                label.className = 'ml-2 block text-sm text-gray-700';
                label.textContent = amenityValue;
                
                // Create remove button
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.className = 'ml-2 remove-amenity text-red-500 hover:text-red-700';
                removeButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                `;
                
                // Add event listener to remove button
                removeButton.addEventListener('click', function() {
                    customAmenitiesList.removeChild(amenityDiv);
                });
                
                // Append all elements
                amenityDiv.appendChild(checkbox);
                amenityDiv.appendChild(label);
                amenityDiv.appendChild(removeButton);
                
                customAmenitiesList.appendChild(amenityDiv);
                
                // Clear input
                customAmenityInput.value = '';
            }
        });
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-amenity').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.custom-amenity').remove();
            });
        });
    </script>
</x-app-layout>