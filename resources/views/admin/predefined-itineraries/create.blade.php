<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Itinerary for {{ $touristSpot->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.predefined-itineraries.store') }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                <input type="hidden" name="tourist_spot_id" value="{{ $touristSpot->id }}">

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Title</label>
                    <input type="text" name="title" class="form-input w-full" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea name="description" class="form-textarea w-full"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Visit Date</label>
                    <input type="date" name="visit_date" class="form-input w-full">
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Visit Time</label>
                    <input type="time" name="visit_time" class="form-input w-full">
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Budget Limit</label>
                    <input type="number" step="0.01" name="budget_limit" class="form-input w-full">
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Save Itinerary
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
