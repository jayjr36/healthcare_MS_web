<!-- resources/views/admin/users.blade.php -->

@extends('layout')

@section('content')
<div class="container">
    <h1>All Users</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger btn-block mb-3">Back to Dashboard</a>
</div>
@endsection
