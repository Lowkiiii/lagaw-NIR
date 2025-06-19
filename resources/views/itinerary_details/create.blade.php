<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <!-- Back to Itinerary -->
            <a href="{{ route('itineraries.show', $itinerary->id) }}"
               class="text-gray-600 hover:text-gray-800"
               title="Back">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 inline-block"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Note to: {{ $itinerary->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded p-6">
            <form action="{{ route('itinerary-details.store', $itinerary->id) }}"
                  method="POST">
                @csrf

                <div class="mb-4">
                    <label for="details" class="block text-gray-700 font-medium mb-1">
                        Itinerary Notes
                    </label>
                    <textarea id="details"
                              name="details"
                              rows="6"
                              class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                              placeholder="Enter your itinerary notes here...">{{ old('details') }}</textarea>
                    @error('details')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Save Note
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
