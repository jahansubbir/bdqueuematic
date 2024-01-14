@extends('layouts.navigation')

<div class='container'>
    <x-app-layout>
        <div class='container'>
            <x-slot name="header">


                <h1>Booth Types</h1>

            </x-slot>
            <div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <a class="btn btn-info" href="{{ route('boothTypes.create') }}">Add New</a>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <!-- <th>Lunch Starts</th>
            <th>Lunch Ends</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boothTypes as $type)
                                <tr>
                                    <td>{{ $type->type }}</td>

                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('boothTypes.edit', ['id' => $type->id]) }}">Edit</a>


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </x-app-layout>
</div>