{{-- resources/views/admin/cafes/create.blade.php --}}
<x-app-layout>
<x-slot name="header">
<div class="flex justify-between items-center">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Add New Cafe') }}
</h2>
<a href="{{ route('admin.cafes.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
Back to Cafes
</a>
</div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('admin.cafes.store') }}" enctype="multipart/form-data">
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

                    <!-- Specialty -->
                    {{-- <div class="mb-4">
                        <x-input-label for="specialty" :value="__('Specialty')" />
                        <x-text-input id="specialty" class="block mt-1 w-full" type="text" name="specialty" :value="old('specialty')" required />
                        <x-input-error :messages="$errors->get('specialty')" class="mt-2" />
                    </div> --}}

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

                    <!-- Opening Hours -->
                    <div class="mb-4">
                        <x-input-label for="opening_hours" :value="__('Opening Hours')" />
                        <x-text-input id="opening_hours" class="block mt-1 w-full" type="text" name="opening_hours" :value="old('opening_hours')" required placeholder="Monday: 9AM-5PM, Tuesday: 10AM-6PM, etc."/>
                        <x-input-error :messages="$errors->get('opening_hours')" class="mt-2" />
                    </div>

                    <!-- Image -->
                    <div class="mb-4">
                        <x-input-label for="img_url" :value="__('Image')" />
                        <input id="img_url" type="file" name="img_url" class="block mt-1 w-full" accept="image/*" />
                        <span class="text-xs text-gray-500">Recommended size: 800x600px. Max file size: 2MB.</span>
                        <x-input-error :messages="$errors->get('img_url')" class="mt-2" />
                    </div>

                    <!-- Is Featured -->
                    <div class="mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="is_featured" class="ml-2 text-sm text-gray-600">Feature this cafe on homepage</label>
                        </div>
                        <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.cafes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            {{ __('Cancel') }}
                        </a>
                        <x-primary-button>
                            {{ __('Create Cafe') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Image preview functionality
    document.getElementById('img_url').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.className = 'w-full h-64 object-cover rounded-md mt-2';
                
                const container = document.getElementById('img_url').parentNode;
                const existingPreview = container.querySelector('img');
                
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                
                container.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</x-app-layout>