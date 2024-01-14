@extends('layouts.navigation')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Add Booth Type
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('boothTypes.store') }}">
                    @csrf   
             <!-- Name -->
        <div>
            <x-input-label for="type" :value="__('Type')" />
            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" required autofocus autocomplete="type" />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
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
