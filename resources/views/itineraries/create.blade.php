<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-black-700 leading-tight">Add Itinerary for {{ $spot->name }}</h2>

            <a href="{{ route('user.tourist-spots.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow-lg rounded-2xl p-6">
            <form id="itinerary-form" action="{{ route('itineraries.store') }}" method="POST">
                @csrf

                <input type="hidden" name="tourist_spot_id" value="{{ $spot->id }}">

                <div class="mb-6">
                    <label for="title" class="text-lg font-semibold text-gray-700">Title</label>
                    <input type="text" id="title" name="title" class="w-full border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="visit_date" class="text-lg font-semibold text-gray-700">Visit Date</label>
                    <input type="date" id="visit_date" name="visit_date" class="w-full border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="visit_time" class="text-lg font-semibold text-gray-700">Visit Time</label>
                    <input type="time" id="visit_time" name="visit_time" class="w-full border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-6">
                    <label for="budget_limit" class="text-lg font-semibold text-gray-700">Budget Limit</label>
                    <input type="number" step="0.01" id="budget_limit" name="budget_limit" class="w-full border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="notes" class="text-lg font-semibold text-gray-700">Description</label>
                    <textarea id="notes" name="notes" class="w-full border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-between gap-4 mt-6">
                    {{-- <button type="button" onclick="suggestItinerary()" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                        Suggest Itinerary
                    </button> --}}

                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                        Save Itinerary
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function suggestItinerary() {
            fetch(`/itineraries/suggest/{{ $spot->id }}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch itinerary suggestion.');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('title').value = data.title || '';
                    document.getElementById('visit_date').value = data.visit_date || '';
                    document.getElementById('visit_time').value = data.visit_time || '';
                    document.getElementById('budget_limit').value = data.budget_limit || '';
                    document.getElementById('notes').value = data.notes || '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Could not fetch itinerary suggestion.');
                });
        }
    </script>
</x-app-layout>
