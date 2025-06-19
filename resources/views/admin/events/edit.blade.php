<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Event</h2>
            <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-md text-sm">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6">
            @csrf
            @method('PUT')

            <x-input-label for="name" value="Event Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required value="{{ old('name', $event->name) }}" />

            <x-input-label for="description" value="Description" class="mt-4" />
            <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded">{{ old('description', $event->description) }}</textarea>

            <x-input-label for="location" value="Location" class="mt-4" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" required value="{{ old('location', $event->location) }}" />

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="start_date" value="Start Date" />
                    <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" required value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}" />
                </div>
                <div>
                    <x-input-label for="end_date" value="End Date" />
                    <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" required value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}" />
                </div>
            </div>

            {{-- <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="latitude" value="Latitude" />
                    <x-text-input id="latitude" name="latitude" type="number" step="any" class="mt-1 block w-full" value="{{ old('latitude', $event->latitude) }}" />
                </div>
                <div>
                    <x-input-label for="longitude" value="Longitude" />
                    <x-text-input id="longitude" name="longitude" type="number" step="any" class="mt-1 block w-full" value="{{ old('longitude', $event->longitude) }}" />
                </div>
            </div> --}}

            <div class="mt-6 flex justify-end">
                <x-primary-button>Update</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
