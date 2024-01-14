@extends('layouts.navigation')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Update Counter
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('counters.update', ['id' => $resource->id]) }}">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $resource->name }}" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- opening hour -->
                        <div class="mt-4">
                            <x-input-label for="opening_hour" :value="__('Opening Hour')" />
                            <x-text-input id="opening_hour" class="block mt-1 w-full" type="text" name="opening_hour"
                                value="{{ $resource->opening_hour }}" required autocomplete="opening_hour" />
                            <x-input-error :messages="$errors->get('opening_hour')" class="mt-2" />
                        </div>
                        <!-- lunch start -->
                        <div class="mt-4">
                            <x-input-label for="lunch_start" :value="__('Lunch  Starts')" />
                            <x-text-input id="lunch_start" class="block mt-1 w-full" type="text" name="lunch_start"
                                value="{{ $resource->lunch_start }}" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('lunch_start')" class="mt-2" />
                        </div>
                        <!-- lunch end -->
                        <div class="mt-4">
                            <x-input-label for="lunch_end" :value="__('Lunch  Ends')" />
                            <x-text-input id="lunch_end" class="block mt-1 w-full" type="text" name="lunch_end"
                                value="{{ $resource->lunch_end }}" required autocomplete="lunch_end" />
                            <x-input-error :messages="$errors->get('lunch_end')" class="mt-2" />
                        </div>

                        <!-- closing hour -->
                        <div class="mt-4">
                            <x-input-label for="closing_hour" :value="__('Closing Hour')" />
                            <x-text-input id="closing_hour" class="block mt-1 w-full" type="text" name="closing_hour"
                                value="{{ $resource->closing_hour }}" required autocomplete="closing_hour" />
                            <x-input-error :messages="$errors->get('closing_hour')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <x-primary-button class="ml-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    flatpickr("#lunch_start", {
        enableTime: true,
        defaultDate: new Date(), //"2024-01-01 16:00" ,
        inline: true,
        noCalendar: true, // Set to true if you want a time-only picker
        defaultHour: 12,         // Set the default hour (change as needed)
              // Set the default minute (change as needed)
        dateFormat: "H:i", // Adjust the date format as needed
    });
    flatpickr("#lunch_end", {
        enableTime: true,
        defaultDate: new Date(), //"2024-01-01 16:00" ,
        inline: true,
        noCalendar: true, // Set to true if you want a time-only picker
        defaultHour: 12,         // Set the default hour (change as needed)
              // Set the default minute (change as needed)
        dateFormat: "H:i", // Adjust the date format as needed
    });

    flatpickr("#opening_hour", {
        enableTime: true,
        defaultDate: new Date(), //"2024-01-01 16:00" ,
        inline: true,
        noCalendar: true, // Set to true if you want a time-only picker
        defaultHour: 12,         // Set the default hour (change as needed)
              // Set the default minute (change as needed)
        dateFormat: "H:i", // Adjust the date format as needed

    });
    flatpickr("#closing_hour", {
        enableTime: true,
        defaultDate: new Date(), //"2024-01-01 16:00" ,
        inline: true,
        noCalendar: true, // Set to true if you want a time-only picker
        defaultHour: 12,         // Set the default hour (change as needed)
              // Set the default minute (change as needed)
        dateFormat: "H:i", // Adjust the date format as needed

    });
</script>