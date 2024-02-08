@extends('layouts.navigation')
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Token Report

        </h2>
    </x-slot>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('admin.report') }}">
                    @csrf   
             <!-- Name -->
      

        <div>
            <x-input-label for="fromDate" :value="__('From Date')" />
            <x-text-input id="fromDate" class="block mt-1 w-full" type="text" name="fromDate" :value="old('fromDate')" required autofocus autocomplete="fromDate" />
            <x-input-error :messages="$errors->get('fromDate')" class="mt-2" />
        </div>

       
        <div>
            <x-input-label for="toDate" :value="__('To Date')" />
            <x-text-input id="toDate" class="block mt-1 w-full" type="text" name="toDate" :value="old('toDate')" required autofocus autocomplete="toDate" />
            <x-input-error :messages="$errors->get('toDate')" class="mt-2" />
        </div>

       
        <div class="flex items-center justify-end mt-4">
          
            <x-primary-button class="ml-4">
                {{ __('Download') }}
            </x-primary-button>
        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
      flatpickr("#fromDate", {
        // enableTime: false,
        // defaultDate: new Date(), //"2024-01-01 16:00" ,
        // inline: true,
        close:true,
        //noCalendar: false, // Set to true if you want a time-only picker
        //defaultHour: 12,         // Set the default hour (change as needed)
              // Set the default minute (change as needed)
        dateFormat: "d-M-Y", // Adjust the date format as needed

    });
    flatpickr("#toDate", {
        // enableTime: false,
        // defaultDate: new Date(), //"2024-01-01 16:00" ,
        // inline: true,
        close:true,
        //noCalendar: false, // Set to true if you want a time-only picker
        //defaultHour: 12,         // Set the default hour (change as needed)
              // Set the default minute (change as needed)
        dateFormat: "d-M-Y", // Adjust the date format as needed

    });
</script>