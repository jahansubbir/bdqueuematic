<!-- resources/views/user_roles/remove.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Remove Role from User</h2>

    <p>Are you sure you want to remove the role "{{ $role->name }}" from user "{{ $user->name }}"?</p>

    <form action="{{ route('user-roles.remove', ['userId' => $user->id, 'roleName' => $role->name]) }}" method="post">
        @csrf
        <button type="submit">Remove Role</button>
    </form>

    <a href="{{ route('user-roles.index') }}">Back to User Roles</a>
@endsection
