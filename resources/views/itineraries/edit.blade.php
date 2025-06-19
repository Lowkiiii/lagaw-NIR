<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-black-700 leading-tight">Edit Itinerary</h2>

            <a href="{{ route('itineraries.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white shadow-lg rounded-2xl p-6">
            <form action="{{ route('itineraries.update', $itinerary->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <input type="hidden" name="tourist_spot_id" value="{{ $itinerary->tourist_spot_id }}">

                <div>
                    <label for="title" class="block text-lg font-semibold text-gray-700">Itinerary Title</label>
                    <input type="text" name="title" required
                        value="{{ old('title', $itinerary->title) }}"
                        class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="visit_date" class="block text-lg font-semibold text-gray-700">Visit Date</label>
                        <input type="date" name="visit_date" required
                            value="{{ old('visit_date', \Carbon\Carbon::parse($itinerary->visit_date)->format('Y-m-d')) }}"
                            class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="visit_time" class="block text-lg font-semibold text-gray-700">Visit Time</label>
                        <input type="time" name="visit_time" required
                            value="{{ old('visit_time', \Carbon\Carbon::parse($itinerary->visit_time)->format('H:i')) }}"
                            class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label for="budget_limit" class="block text-lg font-semibold text-gray-700">Budget Limit (₱)</label>
                    <input type="number" name="budget_limit" step="0.01"
                        value="{{ old('budget_limit', $itinerary->budget_limit) }}"
                        class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="notes" class="block text-lg font-semibold text-gray-700">Notes</label>
                    <textarea name="notes" rows="4"
                        class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ old('notes', $itinerary->notes) }}</textarea>
                </div>

                <div class="flex justify-between gap-4 mt-6">
                    <a href="{{ route('itineraries.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        <i class="fas fa-save mr-2"></i> Update Itinerary
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
