@extends('layouts.navigation')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        Update Booth
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('booths.update',['id' => $resource->id]) }}">
                    @csrf 
                    @method('PUT')
             <!-- Name -->
        <div>
            <x-input-label for="counter_id" :value="__('Counter')" />
            <select name="counter_id" id="counter_id" class="form-control"
            value="{{ $resource->counter_id }}"
            >
    @foreach ($counters as $counter)
        <option value="{{ $counter->id }}">{{ $counter->name }}</option>
    @endforeach
</select>
        
            <x-input-error :messages="$errors->get('counter_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="booth_no" :value="__('Booth Number')" />
            <x-text-input id="booth_no" class="block mt-1 w-full" type="text" name="booth_no" value="{{ $resource->booth_no }}" required autofocus autocomplete="booth_no" />
            <x-input-error :messages="$errors->get('booth_no')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="booth_type_id" :value="__('Booth Type')" />
            <select name="booth_type_id" id="booth_type_id" class="form-control">
    @foreach ($boothTypes as $type)
        <option value="{{ $type->id }}">{{ $type->name }}</option>
    @endforeach
</select>
        
            <x-input-error :messages="$errors->get('counter_id')" class="mt-2" />
        </div>

       
        <div class="flex items-center justify-end mt-4">
          
            <x-primary-button class="ml-4">
                {{ __('Update') }}
            </x-primary-button>
        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
