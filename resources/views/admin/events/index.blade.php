<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Events & Festivals') }}
            </h2>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Event Button -->
                    <div class="mb-4">
                        <a href="{{ route('admin.events.create') }}" class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-md">
                            Add New Event
                        </a>                        
                    </div>

                    <!-- Events Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">ID</th>
                                    <th class="py-2 px-4 border-b text-left">Name</th>
                                    <th class="py-2 px-4 border-b text-left">Location</th>
                                    <th class="py-2 px-4 border-b text-left">Start Date</th>
                                    <th class="py-2 px-4 border-b text-left">End Date</th>
                                    <th class="py-2 px-4 border-b text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $event)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $event->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $event->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $event->location }}</td>
                                        <td class="py-2 px-4 border-b">{{ $event->start_date->format('M d, Y') }}</td>
                                        <td class="py-2 px-4 border-b">{{ $event->end_date->format('M d, Y') }}</td>
                                        <td class="py-2 px-4 border-b flex space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.events.edit', $event->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6 3.536 3.536L12.536 16.536 9 13z" />
                                                </svg>
                                            </a>
                                        
                                            <!-- View Button -->
                                            <a href="{{ route('admin.events.show', $event->id) }}" class="text-green-500 hover:text-green-700" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.events.destroy', $event->id) }}" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-4 px-4 border-b text-center">No events found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination - Only show if using database -->
                    @if(count($events) > 0 && method_exists($events, 'links'))
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>