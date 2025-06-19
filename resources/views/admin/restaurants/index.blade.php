<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Restaurants') }}
            </h2>
            <a href="{{ route('admin.restaurants.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Add New Restaurant') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cuisine Type</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price Range</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                                    <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($restaurants as $restaurant)
                                    <tr>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $restaurant->id }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            @if($restaurant->img_url)
                                                <img src="{{ $restaurant->img_url }}" alt="{{ $restaurant->name }}" class="h-10 w-10 rounded-full object-cover">
                                            @else
                                                <span class="text-gray-400">No Image</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $restaurant->name }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $restaurant->cuisine_type ?? 'N/A' }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $restaurant->location }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">{{ $restaurant->price_range ?? 'N/A' }}</td>
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            @if($restaurant->is_featured)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yes</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">No</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.restaurants.show', $restaurant) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                                <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this restaurant?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="py-4 px-4 text-center text-gray-500">No restaurants found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $restaurants->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
