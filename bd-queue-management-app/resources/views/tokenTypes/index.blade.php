@extends('layouts.navigation')
<div class='container'>
    <x-app-layout>
        <div class='container'>
            <x-slot name="header">


                <h1>Token Types</h1>
            </x-slot>
            <div>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <a class="btn btn-info" href="{{ route('tokenTypes.create') }}">Add Token Types</a>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Token Type</th>
                                    <th>Processing Time</th>
                                    <th>Bulk Processable</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tokenTypes as $type)
                                <tr>
                                    <td>{{$type->id}}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>{{date('H:i:s',strtotime($type->process_duration))}}</td>
                                    @if ($type->is_bulk_processable)
                                    <td>YES</td>
                                    @else
                                    <td>NO</td>    
                                    @endif

                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('tokenTypes.edit', ['id' => $type->id]) }}">Edit</a>


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