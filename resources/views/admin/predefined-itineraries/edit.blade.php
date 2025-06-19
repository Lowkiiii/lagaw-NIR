<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Itinerary - {{ $touristSpot->name }}
            </h2>
            <a href="{{ route('admin.predefined-itineraries.index', $touristSpot->id) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Itineraries
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <form action="{{ route('admin.predefined-itineraries.update', $predefinedItinerary->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $predefinedItinerary->title) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" rows="4" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('description', $predefinedItinerary->description) }}</textarea>
                @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Visit Date</label>
                <input type="date" name="visit_date" value="{{ old('visit_date', $predefinedItinerary->visit_date) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @error('visit_date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Visit Time</label>
                <input type="time" name="visit_time" value="{{ old('visit_time', $predefinedItinerary->visit_time) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @error('visit_time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Budget Limit (₱)</label>
                <input type="number" step="0.01" name="budget_limit" value="{{ old('budget_limit', $predefinedItinerary->budget_limit) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                @error('budget_limit') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.predefined-itineraries.index', $touristSpot->id) }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm rounded">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 text-sm rounded">
                    Update Itinerary
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
