<script src="//unpkg.com/alpinejs" defer></script>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-black-700 leading-tight">
                📝 Reviews for {{ $accommodation->name }}
            </h2>
            <a href="{{ route('user.accommodations.index', $accommodation) }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-full text-sm shadow-lg hover:shadow-xl transition duration-300">
                ← Back
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto space-y-6">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- ACCOMMODATION IMAGE CARD --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">
            @if($accommodation->img_url)
                <div class="relative">
                    <img src="{{ $accommodation->img_url }}" alt="{{ $accommodation->name }}" class="w-full h-60 object-cover">
                    
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <div class="flex justify-between items-end">
                            <div>
                                <h3 class="text-xl font-bold text-white">{{ $accommodation->name }}</h3>
                                <p class="text-white/80 text-sm">{{ $accommodation->location }}</p>
                            </div>
                            <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                {{ $accommodation->type }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- LEAVE A REVIEW FORM --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">🌟 Leave a Review</h3>

            <form method="POST" action="{{ route('accommodation.reviews.store', $accommodation->id) }}" x-data="{ rating: 0 }">
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
                    @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Comment --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Comment</label>
                    <textarea name="comment" required class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" rows="4" placeholder="Tell us about your experience...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-full shadow transition">
                    🎉 Submit Review
                </button>
            </form>
        </div>

        {{-- USER REVIEWS --}}
        <div class="bg-white rounded-xl shadow p-6 space-y-4">
            <h3 class="text-lg font-bold mb-4">💬 What others are saying:</h3>

            @forelse($reviews as $review)
                <div class="border-b pb-4 mb-4">
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