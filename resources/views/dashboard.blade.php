<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAGAW-NIR Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .bg-gradient {
            background-image: linear-gradient(to right, #34d399, #10b981);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #34d399, #10b981);
        }
    </style>
</head>
<body class="bg-gray-50">
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">LAGAW-NIR</h2>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4">
                                <i class="fas fa-map-marker-alt text-green-500"></i>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tourist Spots</div>
                                <div class="text-2xl font-bold">Explore</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 flex items-center">
                            <div class="rounded-full bg-blue-100 p-3 mr-4">
                                <i class="fas fa-hotel text-blue-500"></i>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Hotels</div>
                                <div class="text-2xl font-bold">Find</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 flex items-center">
                            <div class="rounded-full bg-yellow-100 p-3 mr-4">
                                <i class="fas fa-utensils text-yellow-500"></i>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Restaurants</div>
                                <div class="text-2xl font-bold">Taste</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 flex items-center">
                            <div class="rounded-full bg-purple-100 p-3 mr-4">
                                <i class="fas fa-coffee text-purple-500"></i>
                            </div>
                            <div>
                                <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Cafes</div>
                                <div class="text-2xl font-bold">Relax</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Welcome Banner -->
                <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-8">
                    <div class="relative h-48 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/1200x300');">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-green-700 opacity-80"></div>
                        <div class="absolute inset-0 flex items-center justify-center p-8">
                            <div class="text-center text-white">
                                <h2 class="text-3xl font-bold mb-2">Discover the hidden gems of Negros Island Region</h2>
                                <p class="text-lg">Your ultimate travel companion for exploring paradise</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Categories -->
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Explore Categories</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Tourist Spots Card -->
                    <a href="{{ route('user.tourist-spots.index') }}" class="block">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg transition duration-300 card-hover h-full">
                            <div class="h-40 bg-green-50 flex items-center justify-center">
                                <i class="fas fa-map-marked-alt text-5xl text-green-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Tourist Spots</h3>
                                <p class="text-gray-600 mb-4">Discover breathtaking natural wonders and attractions across the Negros Island Region.</p>
                                <div class="flex items-center text-green-500 font-medium">
                                    Explore Now 
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Hotels Card -->
                    <a href="{{ route('user.hotels.index') }}" class="block">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg transition duration-300 card-hover h-full">
                            <div class="h-40 bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-hotel text-5xl text-blue-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Hotels</h3>
                                <p class="text-gray-600 mb-4">Find luxurious and comfortable places to stay during your visit to the region.</p>
                                <div class="flex items-center text-blue-500 font-medium">
                                    Find Accommodations
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Restaurants Card -->
                    <a href="{{ route('user.restaurants.index') }}" class="block">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg transition duration-300 card-hover h-full">
                            <div class="h-40 bg-yellow-50 flex items-center justify-center">
                                <i class="fas fa-utensils text-5xl text-yellow-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Restaurants</h3>
                                <p class="text-gray-600 mb-4">Taste the local cuisine and international dishes at the best restaurants in the region.</p>
                                <div class="flex items-center text-yellow-500 font-medium">
                                    Find Dining Options
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Accommodations Card -->
                    <a href="{{ route('user.accommodations.index') }}" class="block">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg transition duration-300 card-hover h-full">
                            <div class="h-40 bg-indigo-50 flex items-center justify-center">
                                <i class="fas fa-home text-5xl text-indigo-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Accommodations</h3>
                                <p class="text-gray-600 mb-4">Explore various lodging options for every budget throughout Negros Island.</p>
                                <div class="flex items-center text-indigo-500 font-medium">
                                    Browse Accommodations
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Cafes Card -->
                    <a href="{{ route('user.cafes.index') }}" class="block">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg transition duration-300 card-hover h-full">
                            <div class="h-40 bg-purple-50 flex items-center justify-center">
                                <i class="fas fa-coffee text-5xl text-purple-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Cafes</h3>
                                <p class="text-gray-600 mb-4">Relax in cozy cafes with delicious beverages and a comfortable atmosphere.</p>
                                <div class="flex items-center text-purple-500 font-medium">
                                    Discover Cafes
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Itineraries Card -->
                    <a href="{{ route('itineraries.index') }}" class="block">
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg transition duration-300 card-hover h-full">
                            <div class="h-40 bg-red-50 flex items-center justify-center">
                                <i class="fas fa-route text-5xl text-red-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Itineraries</h3>
                                <p class="text-gray-600 mb-4">Plan your perfect trip with custom itineraries and travel schedules.</p>
                                <div class="flex items-center text-red-500 font-medium">
                                    Manage Itineraries
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Quick Access Section -->
                <div class="container mx-auto px-4 py-6">
                    <h2 class="text-xl font-bold mb-4 text-center">Quick Actions</h2>
                    <div class="max-w-md mx-auto bg-white overflow-hidden shadow-sm rounded-lg mb-8">
                        <div class="p-6">
                            <div class="grid grid-cols-2 gap-4">
                                <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                    <i class="fas fa-user-circle text-2xl text-gray-700 mb-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Edit Profile</span>
                                </a>
                                
                                <a href="{{ route('itineraries.index') }}" class="flex flex-col items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-200">
                                    <i class="fas fa-calendar-alt text-2xl text-gray-700 mb-2"></i>
                                    <span class="text-sm font-medium text-gray-700">My Itineraries</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>