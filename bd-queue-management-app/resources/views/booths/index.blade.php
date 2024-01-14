@extends('layouts.navigation')

<x-app-layout>
    <div class='container'>
        <x-slot name="header">

            <h1>Booths</h1>
        </x-slot>
        <div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <a class="btn btn-success" href="{{ route('booths.create') }}">Add Booth</a>
                <p style='color:transparent'>.</p>
                    <table class='table table-striped table-hover table-success'>
                        <thead>
                            <tr>
                                <th>Counter</th>
                                <th>Booth Type</th>
                                <th>Booth No</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booths as $booth)
                            <tr>

                                <td>{{ $booth->counter }}</td>

                                <td>{{ $booth->type }}</td>
                                <td>{{ $booth->booth_no }}</td>
                                <td>
                                    <a class="btn btn-success"
                                        href="{{ route('booths.edit', ['id' => $booth->id]) }}">Edit Booth</a>


                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
</x-app-layout>