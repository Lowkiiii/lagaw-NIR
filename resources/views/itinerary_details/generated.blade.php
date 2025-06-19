<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Suggested Activities</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold mb-4">{{ $itinerary->title }}</h3>

            <div class="whitespace-pre-line text-gray-700">
                {{ $activities }}
            </div>
        </div>
    </div>
</x-app-layout>
