{{-- resources/views/admin/cafes/edit.blade.php --}}
<x-app-layout>
<x-slot name="header">
<div class="flex justify-between items-center">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Edit Cafe') }}
</h2>
<div class="flex space-x-2">
<a href="{{ route('admin.cafes.show', $cafe) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
{{ __('View Details') }}
</a>
<a href="{{ route('admin.cafes.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
{{ __('Back to List') }}
</a>
</div>
</div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('admin.cafes.update', $cafe->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div>
                            <!-- Image Preview -->
                            <div class="mb-6">
                                @if($cafe->img_url)
                                    <img id="image-preview" src="{{ $cafe->img_url }}" alt="{{ $cafe->name }}" class="w-full h-80 object-cover rounded-lg shadow mb-2">
                                @else
                                    <div id="image-preview-placeholder" class="w-full h-80 bg-gray-200 flex items-center justify-center rounded-lg shadow mb-2">
                                        <span class="text-gray-500">No image available</span>
                                    </div>
                                    <img id="image-preview" src="" alt="" class="w-full h-80 object-cover rounded-lg shadow mb-2 hidden">
                                @endif

                                <!-- Image Upload -->
                                <div class="mt-2">
                                    <label for="img_url" class="block text-sm font-medium text-gray-700 mb-1">Cafe Image</label>
                                    <input type="file" name="img_url" id="img_url" accept="image/*" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100">
                                    @error('img_url')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <!-- Basic Information Section -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h3>

                                <!-- Name -->
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $cafe->name) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="description" id="description" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $cafe->description) }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Location -->
                                <div class="mb-4">
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                    <input type="text" name="location" id="location" value="{{ old('location', $cafe->location) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error('location')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Specialty -->
                                {{-- <div class="mb-4">
                                    <label for="specialty" class="block text-sm font-medium text-gray-700 mb-1">Specialty</label>
                                    <input type="text" name="specialty" id="specialty" value="{{ old('specialty', $cafe->specialty) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error('specialty')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div> --}}

                                <!-- Price Range -->
                                <div class="mb-4">
                                    <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                                    <input type="text" name="price_range" id="price_range" value="{{ old('price_range', $cafe->price_range) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error('price_range')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Contact Info -->
                                <div class="mb-4">
                                    <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-1">Contact Info</label>
                                    <input type="text" name="contact_info" id="contact_info" value="{{ old('contact_info', $cafe->contact_info) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @error('contact_info')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Opening Hours -->
                                <div class="mb-4">
                                    <x-input-label for="opening_hours" :value="__('Opening Hours')" />
                                    <x-text-input id="opening_hours" class="block mt-1 w-full" type="text" name="opening_hours" :value="old('opening_hours', $cafe->opening_hours_formatted ?? '')" />
                                    <span class="text-xs text-gray-500">Format: Monday: 9AM-5PM, Tuesday: 10AM-6PM, etc.</span>
                                    <x-input-error :messages="$errors->get('opening_hours')" class="mt-2" />
                                </div>

                                <!-- Featured -->
                                <div class="mb-4 flex items-center space-x-2">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $cafe->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <label for="is_featured" class="block text-sm font-medium text-gray-700">Featured?</label>
                                     @error('is_featured')
                                            p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-primary-button>
                            {{ __('Update') }}
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
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('image-preview-placeholder');
                
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
                
                preview.src = event.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
</x-app-layout>