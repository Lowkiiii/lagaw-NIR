<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Event') }}
            </h2>
            <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Events
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" class="form-textarea w-full">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-input w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-input w-full" required>
                    </div>

                    {{-- <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude') }}" class="form-input w-full">
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude') }}" class="form-input w-full"> --}}
                    </div>

                    <div class="mb-4">
                        <div class="mb-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">Event Image</label>
                            <input type="file" id="image" name="image" class="w-full border rounded p-2">
                        </div>                        
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                            Create Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
