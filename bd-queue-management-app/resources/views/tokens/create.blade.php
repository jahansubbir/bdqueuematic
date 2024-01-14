@extends('layouts.navigation')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Queue Token Collection

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
        <div id='modal-div'>
                <img class="items-center"
                        src="/images/disclaimer.png"></div>
                </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
           
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="col-md-12">
                        <div class="col-md-12">
                            <form method="post" action="{{ route('tokens.store') }}">
                                @csrf
                                <!-- Name -->
                                <div>
                                    <x-input-label for="counter_id" :value="__('Counter')" />
                                    <select name="counter_id" id="counter_id" class="form-control">
                                        @foreach ($counters as $counter)
                                        <option value="{{ $counter->id }}">{{ $counter->name }}</option>
                                        @endforeach
                                    </select>

                                    <x-input-error :messages="$errors->get('counter_id')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="token_type_id" :value="__('Token Type')" />
                                    <select name="token_type_id" id="token_type_id" class="form-control">
                                        @foreach ($tokenTypes as $tokenType)
                                        <option value="{{ $tokenType->id }}">{{ $tokenType->name }}</option>
                                        @endforeach
                                    </select>

                                    <x-input-error :messages="$errors->get('token_type_id')" class="mt-2" />
                                </div>
                                <div class="col-md-12 row" id="container">
                                    <div class="col-md-4">
                                        <x-input-label :value="__('BL Number')" />
                                        <x-text-input id="bl_no[]" class="block mt-1 w-full" type="text" name="bl_no[]"
                                            :value="old('bl_no[]')" required autofocus autocomplete="bl_no[]" />
                                        <x-input-error :messages="$errors->get('bl_no[]')" class="mt-2" />
                                    </div>
                                    <div class="col-md-4">
                                        <x-input-label :value="__('Bill of Entry Number')" />
                                        <x-text-input id="be_no[]" class="block mt-1 w-full" type="text" name="be_no[]"
                                            :value="old('be_no')" required autofocus autocomplete="be_no" />
                                        <x-input-error :messages="$errors->get('booth_no')" class="mt-2" />
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <x-input-label />
                                    <input type="button" id="AddBLButton" class="btn btn-info" value="Add BL" />
                                </div>
                                <div class="items-center justify-end mt-4">

                                    <x-primary-button class="btn btn-success" id="SubmitButton">
                                        {{ __('Get Token') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function () {

        $("#AddBLButton").click(function () {

            var newLine = '<div class="row"><div class="col-md-4"><label class="block mt-1 w-full">BL Number</label><input class="form-control" name="bl_no[]"/></div>' +
                '<div class="col-md-4"><label class="block mt-1 w-full">Bill of Export Number</label><input class="form-control" name="be_no[]"/></div></div>';
            $("#container").append(newLine);
        });


        //text to speech

        

    });


   
</script>