<!-- resources/views/user_roles/assign.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Assign Role to User</h2>

    <form action="{{ route('user-roles.assign', ['userId' => $user->id]) }}" method="post">
        @csrf
        <label for="role">Select Role:</label>
        <select name="role" id="role">
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
        <button type="submit">Assign Role</button>
    </form>

    <a href="{{ route('user-roles.index') }}">Back to User Roles</a>
@endsection
