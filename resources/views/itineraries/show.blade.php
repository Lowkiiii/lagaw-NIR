<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-black-700 leading-tight">Itinerary Details</h2>

            <a href="{{ route('itineraries.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow-lg rounded-2xl p-6">
            <h3 class="text-3xl font-semibold text-blue-600 mb-4">{{ $itinerary->title }}</h3>

            @if($itinerary->touristSpot && $itinerary->touristSpot->img_url)
                <img src="{{ asset('storage/' . $itinerary->touristSpot->img_url) }}"
                     alt="{{ $itinerary->touristSpot->name }}"
                     class="w-full h-64 object-cover rounded-xl mb-6 transition-transform transform hover:scale-105">
            @endif

            <div class="space-y-2 mb-4">
                <p class="text-lg text-gray-800"><strong>Date:</strong>
                    {{ \Carbon\Carbon::parse($itinerary->visit_date)->toFormattedDateString() }}
                </p>
                <p class="text-lg text-gray-800"><strong>Time:</strong>
                    {{ \Carbon\Carbon::parse($itinerary->visit_time)->format('g:i A') }}
                </p>
                @if($itinerary->budget_limit)
                    <p class="text-lg text-gray-800"><strong>Budget:</strong>
                        ₱{{ number_format($itinerary->budget_limit, 2) }}
                    </p>
                @endif
                <p class="text-lg text-gray-800"><strong>Description:</strong>
                    {{ $itinerary->notes }}
                </p>
            </div>

            @if($itinerary->details->count())
                <div class="mt-6">
                    <h4 class="font-semibold text-xl text-blue-600 mb-3">Additional Notes</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        @foreach($itinerary->details as $detail)
                            <li>{!! nl2br(e($detail->details)) !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-8 flex justify-center">
                <a href="{{ route('itinerary.details.create', $itinerary->id) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                    Add Note
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
