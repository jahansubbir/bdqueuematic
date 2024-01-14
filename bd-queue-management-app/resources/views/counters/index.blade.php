@extends('layouts.navigation')
<!-- <div class='container' style='margin-top:100px;'> -->
<x-app-layout>
    <x-slot name="header">
        <h1>Counters</h1>
    </x-slot>
    <div class='container'>
        
        

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="btn btn-success" href="{{ route('counters.create') }}">Add Counter</a>
            <p style='color:transparent'>.</p>
                <table class='table table-striped table-hover table-info'>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Opening Hour</th>
                            <th>Lunch Starts</th>
                            <th>Lunch Ends</th>
                            <th>Closing Hour</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($counters as $counter)
                        <tr>
                            <td>{{ $counter->name }}</td>
                            <td>{{ $counter->opening_hour->format('h:i:s') }}</td>
                            <td>{{ $counter->lunch_start->format('h:i:s') }}</td>
                            <td>{{ $counter->lunch_end->format('h:i:s') }}</td>
                            <td>{{ $counter->closing_hour->format('h:i:s') }}</td>
                            <td>
                                <a class="btn btn-success"
                                    href="{{ route('counters.edit', ['id' => $counter->id]) }}">Edit</a>


                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- </div> -->