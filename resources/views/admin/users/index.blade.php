<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Users') }}
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
                    
                    @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- <!-- Add User Button -->
                    <div class="mb-4">
                        <a href="#" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                            Add New User
                        </a>
                    </div> --}}

                    <!-- Users Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b text-left">ID</th>
                                    <th class="py-2 px-4 border-b text-left">Name</th>
                                    <th class="py-2 px-4 border-b text-left">Email</th>
                                    <th class="py-2 px-4 border-b text-left">Contact Number</th>
                                    <th class="py-2 px-4 border-b text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->contact_number }}</td>
                                        <td class="py-2 px-4 border-b flex space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6-6 3.536 3.536L12.536 16.536 9 13z" />
                                                </svg>
                                            </a>
                                        
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
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
                                        <td colspan="5" class="py-4 px-4 border-b text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>