<!-- resources/views/user_roles/index.blade.php -->

@extends('layouts.navigation')
<div name="header" class='container'>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">User Roles Management</h2>
        </x-slot>
        <div class='container'>



            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <table class='table table-striped table-hover table-info' id="user-roles-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                <td>
                                    <form action="{{ route('user-roles.assign', ['userId' => $user->id]) }}"
                                        method="post">
                                        @csrf
                                        <select name="role" class="form-control">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-warning">Assign Role</button>
                                    </form>

                                    @foreach($user->roles as $role)
                                    <form
                                        action="{{ route('user-roles.remove', ['userId' => $user->id, 'roleName' => $role->name]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Remove {{ $role->name }}</button>
                                    </form>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
    </x-app-layout>
</div>

<script>
    $(document).ready(function () {
        var isSelectCreated = false;
        //var roleData=createSelect();
      var table=  $('#user-roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user-roles.searchableIndex') }}",
       
            columns: [

                { data: 'name', name: 'name' },
                { data: 'role', name: 'role' },
                //    {data:'id',render:function(){return '<button class="btn btn-success">Assign</button>' }},
                { data: "id", name:'Actionable',
                    render: function (data) {
                        if (!isSelectCreated) {
                            createSelect();
                            isSelectCreated = true;
                        }
                        // if(roleData!=undefined){
                        //  createSelect(data);
                        // }
                        return '<form id="myForm" method="POST" action="{{route("user-roles.assign",["userId"=>$user->id])}}"> @csrf <select class="form-control" id="dropdown" name="roleName">' +

                            '</select><button type="submit" class="btn btn-warning">Assign Role</button></form>';
                            
                    }
                },
                           ]
        });
        table.column('columnname:name').search("keyword").draw(function (params) {
            alert(params);
        });
        table.on('search.dt', function() {
            isSelectCreated=false;
            
        });
    });
    // var assignButton= function(data) {
    // return '<button>Assign</button>';
    function createSelect(id) {

        $.ajax({
            url: "{{ route('user-roles.roles') }}",
            type: 'get',
            dataType: 'json',
            //  data: id,
            cache: false,
            contentType: "application/json",
            processData: true,
            timeout: 10000,
            success: function (response) {
                //return response;
                for (var i = 0; i < response.length; i++) {
                    $("select").append($("<option>", {
                        response: response[i].id,
                        text: response[i].name
                    }));
                }
            }
        });
    }

    $(document).ready(function () {
    // Attach a submit event handler to the form with the ID 'myForm'
    $('#myForm').submit(function (e) {
        // Prevent the default form submission behavior
        e.preventDefault();

        // Serialize the form data
        var formData = $(this).serialize();

        // Perform an AJAX request to submit the form
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            success: function (response) {
                // Handle the success response from the server
                console.log(response);
            },
            error: function (error) {
                // Handle the error response from the server
                console.log(error);
            }
        });
    });
});

</script>