<!-- resources/views/user_roles/index.blade.php -->

@extends('layouts.navigation')

<div class='container'>
    <x-app-layout>
        <x-slot name="header">

            <h2>User Roles Management</h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <table class='table table-striped table-hover' id="user-roles-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Roles</th>
                            <th>Actions</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </x-app-layout>
</div>

<script>
    $(document).ready(function () {

        
        $('#user-roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user-roles.index') }}",
          
            columns: [

                { data: 'name', name: 'name' },
                { data: 'role', name: 'role' },
               {data:'id',render:function(){return '<button class="btn btn-success">Assign</button>' }}
            ]
        });
    });
    var assignButton= function(data) {
    return '<button>Assign</button>';
  }
</script>