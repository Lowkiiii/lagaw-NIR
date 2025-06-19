<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Tourist Spot') }}
            </h2>
            <a href="{{ route('admin.tourist-spots.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Tourist Spots
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.tourist-spots.store') }}" enctype="multipart/form-data">
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

                        <!-- Image -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <input id="image" type="file" name="image" class="block mt-1 w-full" accept="image/*" />
                            <span class="text-xs text-gray-500">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB.</span>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- <!-- Latitude -->
                        <div class="mb-4">
                            <x-input-label for="latitude" :value="__('Latitude')" />
                            <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude" :value="old('latitude')" placeholder="Example: 14.5995" />
                            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                        </div>

                        <!-- Longitude -->
                        <div class="mb-4">
                            <x-input-label for="longitude" :value="__('Longitude')" />
                            <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude" :value="old('longitude')" placeholder="Example: 120.9842" />
                            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                        </div> --}}

                        <!-- Opening Hours -->
                        <div class="mb-4">
                            <x-input-label for="openinghours" :value="__('Opening Hours')" />
                            <x-text-input id="openinghours" class="block mt-1 w-full" type="text" name="openinghours" :value="old('openinghours')" placeholder="e.g. Monday-Friday: 9AM-5PM" />
                            <x-input-error :messages="$errors->get('openinghours')" class="mt-2" />
                        </div>

                        <!-- Featured -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <label for="is_featured" class="ml-2 text-sm text-gray-600">Feature this tourist spot on homepage</label>
                            </div>
                            <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.tourist-spots.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Create Tourist Spot') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
