<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Accommodation') }}
            </h2>

            <a href="{{ route('admin.accommodations.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Hotels
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.accommodations.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <x-input-label for="location" :value="__('Location')" />
                            <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="" disabled selected>Select accommodation type</option>
                                <option value="Hotel" {{ old('type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                                <option value="Resort" {{ old('type') == 'Resort' ? 'selected' : '' }}>Resort</option>
                                <option value="Hostel" {{ old('type') == 'Hostel' ? 'selected' : '' }}>Hostel</option>
                                <option value="Apartment" {{ old('type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                <option value="Guest House" {{ old('type') == 'Guest House' ? 'selected' : '' }}>Guest House</option>
                                <option value="Villa" {{ old('type') == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="Cottage" {{ old('type') == 'Cottage' ? 'selected' : '' }}>Cottage</option>
                                <option value="Cabin" {{ old('type') == 'Cabin' ? 'selected' : '' }}>Cabin</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <x-input-label for="price_range" :value="__('Price Range')" />
                            <x-text-input id="price_range" class="block mt-1 w-full" type="text" name="price_range" :value="old('price_range')" required placeholder="e.g. ₱200-₱500" />
                            <x-input-error :messages="$errors->get('price_range')" class="mt-2" />
                        </div>

                        <!-- Contact Info -->
                        <div class="mb-4">
                            <x-input-label for="contact_info" :value="__('Contact Information')" />
                            <x-text-input id="contact_info" class="block mt-1 w-full" type="text" name="contact_info" :value="old('contact_info')" required placeholder="Phone, email, website, etc." />
                            <x-input-error :messages="$errors->get('contact_info')" class="mt-2" />
                        </div>

                        <!-- Amenities -->
                        <div class="mb-6">
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
                                    @endphp

                                    @foreach($commonAmenities as $amenity)
                                        <div class="flex items-center">
                                            <input id="amenity-{{ Str::slug($amenity) }}" name="amenities[]" value="{{ $amenity }}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                                                {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}>
                                            <label for="amenity-{{ Str::slug($amenity) }}" class="ml-2 block text-sm text-gray-700">{{ $amenity }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Custom Amenity Input -->
                                <div class="mt-4">
                                    <label for="custom_amenity" class="block text-sm font-medium text-gray-700 mb-1">Add Custom Amenity</label>
                                    <div class="flex">
                                        <input type="text" id="custom_amenity" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md rounded-r-none" placeholder="e.g. Rooftop Bar">
                                        <button type="button" id="add_amenity" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Add
                                        </button>
                                    </div>
                                </div>

                                <!-- Custom Amenities List -->
                                <div id="custom_amenities_list" class="mt-2 grid grid-cols-2 gap-2">
                                    @foreach(old('amenities', []) as $amenity)
                                        @if (!in_array($amenity, $commonAmenities))
                                            <div class="flex items-center custom-amenity">
                                                <input name="amenities[]" value="{{ $amenity }}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" checked>
                                                <label class="ml-2 block text-sm text-gray-700">{{ $amenity }}</label>
                                                <button type="button" class="ml-2 remove-amenity text-red-500 hover:text-red-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            @error('amenities')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Image -->
                        <div class="mb-4">
                            <x-input-label for="img_url" :value="__('Image')" />
                            <input id="img_url" type="file" name="img_url" class="block mt-1 w-full" accept="image/*" />
                            <span class="text-xs text-gray-500">Recommended size: 800x600px. Max file size: 2MB.</span>
                            <x-input-error :messages="$errors->get('img_url')" class="mt-2" />
                        </div>

                        <!-- Featured -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="is_featured" class="ml-2 text-sm text-gray-600">Feature this accommodation on homepage</label>
                            </div>
                            <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.accommodations.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Accommodation') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- JavaScript for handling custom amenities -->
<script>
    document.getElementById('add_amenity').addEventListener('click', function() {
        const input = document.getElementById('custom_amenity');
        const value = input.value.trim();

        if (value !== '') {
            const list = document.getElementById('custom_amenities_list');

            const container = document.createElement('div');
            container.className = 'flex items-center custom-amenity';

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'amenities[]';
            checkbox.value = value;
            checkbox.checked = true;
            checkbox.className = 'h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded';

            const label = document.createElement('label');
            label.className = 'ml-2 block text-sm text-gray-700';
            label.textContent = value;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'ml-2 remove-amenity text-red-500 hover:text-red-700';
            removeBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `;

            removeBtn.addEventListener('click', function() {
                list.removeChild(container);
            });

            container.appendChild(checkbox);
            container.appendChild(label);
            container.appendChild(removeBtn);

            list.appendChild(container);
            input.value = '';
        }
    });

    document.querySelectorAll('.remove-amenity').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.custom-amenity').remove();
        });
    });
</script>
