@extends('layouts.navigation')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
Add Token Type
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('tokenTypes.update', ['id' => $resource->id]) }}">
                    @csrf   
                    @method('PUT') 
             <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $resource->name }}" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="process_duration" :value="__('Process duration')" />
            <x-text-input id="process_duration" class="block mt-1 w-full" type="text" name="process_duration" value="{{ $resource->process_duration }}" required autofocus autocomplete="process_duration" />
            <x-input-error :messages="$errors->get('process_duration')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="is_bulk_processable" :value="__('Bulk Processable')" />
            <!-- <input type="checkbox" id="is_bulk_processable" name="is_bulk_processable" value="1"  class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
            autofocus autocomplete="is_bulk_processable" @if($resource->is_bulk_processable) checked @endif/> -->
            <input type="checkbox" name="is_bulk_processable" id="is_bulk_processable">
            <x-input-error :messages="$errors->get('is_bulk_processable')" class="mt-2" />
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
  flatpickr("#process_duration", {
        enableTime: true,
        defaultHour:00,
        defaultMinute:05,
        time_24hr:true,
        hourIncrement:1,
        noCalendar: true, // Set to true if you want a time-only picker
        dateFormat: "H:i:s", // Format for displaying the time
    });
   
</script>
