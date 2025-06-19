<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('admin.users.index') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                            <h4 class="font-medium">Manage Users</h4>
                            <p class="text-sm text-gray-600">View User Accounts</p>
                        </a>
                        
                        <a href="{{ route('admin.tourist-spots.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100">
                            <h4 class="font-medium">Tourist Spots</h4>
                            <p class="text-sm text-gray-600">Manage Tourist Spots and their details</p>
                        </a>
                        
                        <a href="{{ route('admin.events.index') }}" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100">
                            <h4 class="font-medium">Events & Festivals</h4>
                            <p class="text-sm text-gray-600">Manage upcoming events</p>
                        </a>
                        
                        <a href="{{ route('admin.hotels.index') }}" class="block p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100">
                            <h4 class="font-medium">Hotels</h4>
                            <p class="text-sm text-gray-600">Manage hotels and their details</p>
                        </a>
                        
                        <a href="{{ route('admin.restaurants.index') }}" class="block p-4 bg-red-50 rounded-lg hover:bg-red-100">
                            <h4 class="font-medium">Restaurants</h4>
                            <p class="text-sm text-gray-600">Manage restaurants and their details</p>
                        </a>

                        <a href="{{ route('admin.accommodations.index') }}" class="block p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100">
                            <h4 class="font-medium">Accommodations</h4>
                            <p class="text-sm text-gray-600">Manage accommodations and their details</p>
                        </a>

                        <a href="{{ route('admin.cafes.index') }}" class="block p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100">
                            <h4 class="font-medium">Cafes</h4>
                            <p class="text-sm text-gray-600">Maanage cafes and their details</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>