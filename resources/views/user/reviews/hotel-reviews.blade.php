<script src="//unpkg.com/alpinejs" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black-700 leading-tight">
                📝 Reviews for {{ $hotel->name }}
            </h2>
            <a href="{{ route('user.hotels.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto space-y-6">

        {{-- HOTEL IMAGE CARD --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            @if($hotel->img_url)
                <div class="relative">
                    <img src="{{ asset('storage/' . $hotel->img_url) }}" alt="{{ $hotel->name }}" class="w-full h-60 object-cover">
                </div>
            @endif
        </div>

        {{-- LEAVE A REVIEW FORM --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">🌟 Leave a Review</h3>

            <form method="POST" action="{{ route('hotel.reviews.store', $hotel->id) }}" x-data="{ rating: 0 }">
                @csrf

                {{-- Star Rating --}}
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Your Rating</label>
                    <div class="flex space-x-1 text-yellow-400">
                        <template x-for="i in 5">
                            <svg @click="rating = i" :class="{ 'opacity-100': i <= rating, 'opacity-30': i > rating }"
                                 class="w-8 h-8 cursor-pointer transition-opacity duration-200"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.951h4.15c.969 0 1.371 1.24.588 1.81l-3.36 2.442 
                                1.287 3.95c.3.922-.755 1.688-1.538 1.118L10 13.347l-3.364 2.41c-.783.57-1.837-.196-1.537-1.118l1.286-3.95
                                -3.36-2.442c-.783-.57-.38-1.81.588-1.81h4.15L9.05 2.927z" />
                            </svg>
                        </template>
                        <input type="hidden" name="rating" :value="rating">
                    </div>
                </div>

                {{-- Comment --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea name="comment" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-pink-500 focus:border-pink-500" rows="4" placeholder="Tell us about your experience..."></textarea>
                </div>

                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-full shadow transition">
                    🎉 Submit Review
                </button>
            </form>
        </div>

        {{-- USER REVIEWS --}}
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h3 class="text-lg font-bold mb-4">💬 What others are saying:</h3>

            @forelse($reviews as $review)
                <div class="border-b pb-4">
                    <div class="flex justify-between items-center">
                        <p class="font-semibold text-blue-600">{{ $review->user->name }}</p>
                        <span class="text-sm text-gray-500">{{ $review->review_date->format('F j, Y') }}</span>
                    </div>

                    {{-- Star Rating Output --}}
                    <div class="flex items-center space-x-1 mt-1 text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.951h4.15c.969 0 1.371 1.24.588 1.81l-3.36 2.442 
                                         1.287 3.95c.3.922-.755 1.688-1.538 1.118L10 13.347l-3.364 2.41c-.783.57-1.837-.196-1.537-1.118l1.286-3.95
                                         -3.36-2.442c-.783-.57-.38-1.81.588-1.81h4.15L9.05 2.927z" />
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-700 mt-2">{{ $review->comment }}</p>
                </div>
            @empty
                <p class="text-gray-500">No reviews yet. Be the first to share your thoughts!</p>
            @endforelse
        </div>
    </div>
</x-app-layout>