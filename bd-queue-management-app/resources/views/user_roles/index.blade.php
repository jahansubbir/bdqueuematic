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
                                <th>Email</th>
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
        var table = $('#user-roles-table').DataTable(
            {
                processing: true,
                serverSide: true,
                ajax: "{{ route('user-roles.searchableIndex') }}",

                columns: [

                    { data: 'name', name: 'name' },
                    {data:'email',name:'email',
                        render:function(data){
return '<a href="/profile/1" class="btn btn-link">'+data+'</a>';
                    }
                },
                    { data: 'role', name: 'role' },
                    //    {data:'id',render:function(){return '<button class="btn btn-success">Assign</button>' }},
                    {
                        data: "id", name: 'ActionableA',
                        render: function (data) {
                           
                            const uId = data;
                           // var createLink=viewDetailLink(data);
                            if (!isSelectCreated) {
                                isSelectCreated = true;
                                return createForm(uId, false);

                            } else {
                                return  createForm(uId, true);
                            }

                            //return form;
                        }
                    }
                    
                   
                ],
            
            });
        table.column('columnname:name').search("keyword").draw(function (params) {
            alert(params);
        });
        table.on('search.dt', function () {
            isSelectCreated = false;

        });

        function viewDetailLink(data) {
            
            return '<button>Details</button>'
        }
        // Event listener for row selection
        $('#user-roles-table').on('click', 'tbody tr', function () {
            
            var selectedData = table.row(this).data();

            // Perform your action with the selected data
            console.log('Selected Row Data:', selectedData);
        });

        // Event listener for DataTables 'select' event
        table.on('select', function (e, dt, type, indexes) {
            if (type === 'row') {
                // Row selected
                console.log('Row Selected:', indexes);
            }
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
    function createForm(id, isSelectCreated) {
        const uId = id;
        var form = document.createElement('form');
        form.id = 'myForm';
        form.method = 'POST';
        form.action = ''; // The action will be set dynamically later

        // Create the CSRF token input field
        var csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}'; // Use Blade to get the CSRF token
        form.appendChild(csrfInput);

        // Create the select element
        var select = document.createElement('select');
        select.className = 'form-control';
        select.id = 'dropdown';
        select.name = 'role';
        // Add your select options here if needed

        // Create the submit button
        var submitButton = document.createElement('button');
        submitButton.type = 'submit';
        submitButton.className = 'btn btn-warning';
        submitButton.textContent = 'Assign Role';

        // Append select and button to the form
        form.appendChild(select);
        form.appendChild(submitButton);

        // Set the action attribute dynamically
        form.action = '{{ route("user-roles.assign", ["userId" => ":userId"]) }}'.replace(':userId', uId);
        if (!isSelectCreated) {
            createSelect();
            isSelectCreated = true;
        }
        // Now you can use the 'form' variable as needed
    //    console.log(form.outerHTML);
        return form.outerHTML;
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